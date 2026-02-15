<?php

declare(strict_types=1);

namespace App\Livewire\Ticket;

use App\Enums\NotificationTypesEnum;
use App\Jobs\SupportTicketJob;
use App\Models\Company;
use App\Models\IncidentType;
use App\Models\SupportTicketStatus;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Anonymous extends Component
{
    use WithFileUploads;

    public ?array $departments = [];
    public ?array $incident_types = [];
    public bool $is_priority = true;
    public bool $submitted = false;
    public ?string $ticket_reference = null;
    public string $company_uuid;
    public string $company_name;
    public ?Company $company = null;

    #[Validate(['required', 'integer', 'exists:departments,id'])]
    public ?int $department_id = null;

    #[Validate(['required', 'integer', 'exists:incident_types,id'])]
    public ?int $incident_type_id = null;

    #[Validate(['required', 'string', 'min:3', 'max:255'])]
    public ?string $title = null;

    #[Validate(['required', 'string', 'min:3'])]
    public ?string $description = null;

    #[Validate(['nullable', 'email'])]
    public ?string $contact_email = null;

    #[Validate(['nullable', 'string', 'min:3', 'max:255'])]
    public ?string $contact_name = null;

    #[Validate(['nullable', 'array'])]
    public $evidence_files = [];

    public function mount()
    {
        $this->company = Company::where('uuid', $this->company_uuid)->first();
        if (! $this->company) {
            abort(404);
        }
        $this->company_name = $this->company->name;
        $this->departments = $this->company->departments()->pluck('name', 'id')->toArray();
        $this->incident_types = IncidentType::pluck('name', 'id')->toArray();

        $this->is_priority = true;
    }

    public function createTicket(): void
    {
        $this->validate();

        if (! empty($this->evidence_files) && collect($this->evidence_files)->contains(fn ($file) => ! $file->isValid())) {
            $this->dispatch('toast', message: __('Los archivos aún se están subiendo. Por favor, espera a que termine la carga.'), type: NotificationTypesEnum::WARNING->value);

            return;
        }

        $evidence_paths = [];
        if (! empty($this->evidence_files)) {
            foreach ($this->evidence_files as $file) {
                $original = $file->getClientOriginalName();
                $file_name = $this->company->id.'_'.Str::replace(' ', '_', trim(Str::lower($this->company->name))).'_'.time().'_'.$original;
                $file_path = $file->storeAs('tickets', $file_name, 'public');
                $evidence_paths[] = $file_path;
            }
        }

        $tracking_uuid = (string) str_pad(mt_rand(0, 999999), 8, '0', STR_PAD_LEFT);

        SupportTicketJob::dispatch(
            company: $this->company->id,
            department: $this->department_id,
            incident_type: $this->incident_type_id,
            support_ticket_status: SupportTicketStatus::where('name', 'abierto')->first()->id,
            created_by_user: null,
            title: $this->title,
            description: $this->description,
            is_priority: $this->is_priority,
            is_anonymous: true,
            evidence_files: $evidence_paths,
            created_by_ai: false,
            alert_id: null,
            alert_uuid: null,
            contact_email: $this->contact_email,
            contact_name: $this->contact_name,
            tracking_uuid: $tracking_uuid,
        );

        $this->ticket_reference = $tracking_uuid;
        $this->submitted = true;
        $this->dispatch('toast', message: __('Ticket creado correctamente.'), type: NotificationTypesEnum::SUCCESS->value);
    }

    public function resetForm(): void
    {
        $this->reset([
            'department_id',
            'incident_type_id',
            'title',
            'description',
            'contact_email',
            'contact_name',
            'is_priority',
            'evidence_files',
            'submitted',
            'ticket_reference',
        ]);
    }

    public function render()
    {
        return view('livewire.ticket.anonymous');
    }
}
