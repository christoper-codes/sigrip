<?php

declare(strict_types=1);

namespace App\Livewire\Application;

use App\Actions\Application\GenerateQrAction;
use App\Enums\NotificationTypesEnum;
use App\Jobs\UserApplicationJob;
use App\Livewire\Forms\ApplicationForm;
use App\Livewire\Traits\LimitItems;
use App\Livewire\Traits\Roles;
use App\Livewire\Traits\Table;
use App\Models\Application;
use App\Models\Department;
use App\Models\Questionnaire;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    use LimitItems;
    use Roles;
    use Table;

    public ApplicationForm $form;
    public ?Application $application = null;
    public ?int $application_id = null;
    public ?string $application_name = null;

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    public bool $search_applications = false;
    public array $departments = [];

    public function mount()
    {
        $this->items_per_page = 5;
        $this->departments = Department::where('company_id', Auth::user()->company?->id)
            ->get()
            ->toArray();
        if (! $this->departments) {
            $this->dispatch('toast', message: __('No hay departamentos disponibles.'), type: NotificationTypesEnum::WARNING->value);
        }

        $this->search_fields = ['questionnaire.name'];
        $this->headers = [
            ['label' => __('Nombre del cuestionario'), 'field' => 'questionnaire.name', 'sortable' => true],
            ['label' => __('Fecha de creación'), 'field' => 'created_at', 'sortable' => true],
            ['label' => __('Compartir aplicación')],
            ['label' => __('Resultados y análisis Ai')],
            ['label' => __('Respuestas'), 'field' => 'questionnaire_responses_count', 'sortable' => true],
            ['label' => __('Departamento emisor')],
            ['label' => __('Fecha de inicio'), 'field' => 'created_at', 'sortable' => true],
            ['label' => __('Fecha de caducidad'), 'field' => 'expiration_date', 'sortable' => true],
            ['label' => __('Estado')],
            ['label' => __('Activar')],
            ['label' => __('Acciones')],
        ];

        $department = Department::where('company_id', Auth::user()->company?->id)
            ->where('metadata->hr_department', true)
            ->first();

        $this->form->department = $department ? $department->toArray() : [];

        $this->form->issuing_department = $this->form->department['id'] ?? null;

        $departments = Department::where('company_id', Auth::user()->company?->id)
            ->get();
        $this->form->departments = $departments ? $departments->toArray() : [];

        $this->form->questionnaires = Questionnaire::where(function ($query) {
            $query->where('is_base', true)
                ->orWhere('company_id', Auth::user()->company?->id);
        })
            ->get()
            ->toArray();
        if ($this->department) {
            $this->searchApplications();
        }
    }

    public function searchApplications(): void
    {
        $this->validateOnly('department');
        $this->table_items = Application::where('executing_department_id', $this->department)
            ->with('questionnaire', 'issuingDepartment', 'executingDepartment', 'users')
            ->withCount('questionnaireResponses')
            ->orderByDesc('created_at')
            ->limit($this->items_per_page)
            ->get()
            ->toArray();

        $this->current_page = 1;
        $this->search_query = '';
        $this->refreshTableData();
        $this->search_applications = true;
    }

    public function updateStatus(int $id): void
    {
        $application = Application::find($id);

        $application->is_active = ! $application->is_active;
        $application->save();

        $this->searchApplications();
        $this->dispatch('toast', message: __('Estado actualizado correctamente.'), type: NotificationTypesEnum::SUCCESS->value);
    }

    public function editApplication(int $id): void
    {
        $this->application = Application::find($id);
        $this->application_id = $this->application->id;
        $this->form->issuing_department = $this->application->issuing_department_id;
        $this->form->executing_department = $this->application->executing_department_id;
        $this->form->questionnaire = $this->application->questionnaire_id;
        $this->form->start_date = $this->application->start_date ? date('Y-m-d', strtotime($this->application->start_date)) : null;
        $this->form->expiration_date = $this->application->expiration_date ? date('Y-m-d', strtotime($this->application->expiration_date)) : null;
        $this->form->auth_required = $this->application->auth_required;

        Flux::modal('edit-application-modal')->show();
    }

    public function confirmUpdateApplication(): void
    {
        $this->form->validate();

        $application = Application::find($this->application_id);
        if ($application->questionnaireResponses()->exists() &&
            (
                $application->executing_department_id !== $this->form->executing_department ||
                $application->questionnaire_id !== $this->form->questionnaire ||
                $application->auth_required !== $this->form->auth_required
            )
        ) {
            Flux::modal('edit-application-modal')->close();
            $this->dispatch('toast', message: __('No se puede modificar estas propiedades de una aplicación que ya tiene respuestas.'), type: NotificationTypesEnum::ERROR->value);

            return;
        }

        $exists_application = Application::where('issuing_department_id', $this->form->issuing_department)
            ->where('executing_department_id', $this->form->executing_department)
            ->where('questionnaire_id', $this->form->questionnaire)
            ->where('start_date', $this->form->start_date)
            ->where('id', '!=', $this->application_id)
            ->exists();
        if ($exists_application) {
            Flux::modal('edit-application-modal')->close();
            $this->dispatch('toast', message: __('Ya existe una aplicación activa con los mismos parámetros.'), type: NotificationTypesEnum::ERROR->value);

            return;
        }

        DB::beginTransaction();
        try {
            $original_auth_required = $application->auth_required;
            $original_questionnaire_id = $application->questionnaire_id;
            $original_slug = $application->slug;
            if ($original_questionnaire_id !== $this->form->questionnaire) {
                $questionnaire_name = collect($this->form->questionnaires)
                    ->where('id', $this->form->questionnaire)
                    ->first()['name'];
                $this->form->slug = Str::slug($questionnaire_name.'-'.uniqid());
                $this->form->url_qr = route('application.show', ['slug' => $this->form->slug]);
            }

            $application->issuing_department_id = $this->form->issuing_department;
            $application->executing_department_id = $this->form->executing_department;
            $application->questionnaire_id = $this->form->questionnaire;
            $application->auth_required = $this->form->auth_required;
            $application->start_date = $this->form->start_date;
            $application->expiration_date = $this->form->expiration_date;
            $application->slug = $this->form->slug ?? $application->slug;
            $application->save();

            if ((bool) $original_auth_required !== (bool) $this->form->auth_required) {
                UserApplicationJob::dispatch(
                    department_id: $this->form->executing_department,
                    company_id: Auth::user()->company?->id,
                    application: $application,
                    store: (bool) $this->form->auth_required,
                );
            }

            if ($original_questionnaire_id !== $this->form->questionnaire) {
                Storage::disk('public')->delete('qrs/'.$original_slug.'.svg');
                (new GenerateQrAction)->execute(url: $this->form->url_qr, slug: $this->form->slug);
            }

            DB::commit();
            $this->reset([
                'form.issuing_department',
                'form.executing_department',
                'form.questionnaire',
                'form.auth_required',
                'form.start_date',
                'form.expiration_date',
            ]);
            $this->searchApplications();
            Flux::modal('edit-application-modal')->close();
            $this->dispatch('toast', message: __('Aplicación actualizada correctamente.'), type: NotificationTypesEnum::SUCCESS->value);
        } catch (\Exception $e) {
            DB::rollBack();
            Flux::modal('edit-application-modal')->close();
            $this->dispatch('toast', message: __('Error al actualizar la aplicación: ').$e->getMessage(), type: NotificationTypesEnum::ERROR->value);
        }
    }

    public function confirmDestroy(string $application_name, int $id): void
    {
        $this->application_name = $application_name;
        $this->application_id = $id;

        Flux::modal('destroy-application-modal')->show();
    }

    public function destroy(): void
    {
        $application = Application::find($this->application_id);
        if ($application->questionnaireResponses()->exists()) {
            Flux::modal('destroy-application-modal')->close();
            $this->dispatch('toast', message: __('No se puede eliminar una aplicación que ya tiene respuestas.'), type: NotificationTypesEnum::ERROR->value);

            return;
        }
        $application_slug = $application->slug;
        $application->delete();
        UserApplicationJob::dispatch(
            department_id: $application->executing_department_id,
            company_id: Auth::user()->company?->id,
            application: $application,
            store: false,
        );
        Storage::disk('public')->delete('qrs/'.$application_slug.'.svg');

        $this->searchApplications();
        Flux::modal('destroy-application-modal')->close();
        $this->dispatch('toast', message: __('Aplicación eliminada correctamente.'), type: NotificationTypesEnum::SUCCESS->value);
    }

    public function editModalClosed()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function shareApplication(int $id): void
    {
        $application = Application::find($id);
        $this->form->slug = $application->slug;
        $this->form->url_qr = route('application.show', ['slug' => $this->form->slug]);

        Flux::modal('index-qr-application-modal')->show();
    }

    public function render()
    {
        return view('livewire.application.index');
    }
}
