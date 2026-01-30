<?php
namespace App\Livewire\Ticket;

use App\Enums\NotificationTypesEnum;
use App\Jobs\SupportTicketJob;
use App\Models\Department;
use App\Models\IncidentType;
use App\Models\SupportTicket;
use App\Models\SupportTicketStatus;
use App\Models\Company;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Anonymous extends Component
{
    use WithFileUploads;

    public ?array $departments = [];
    public ?array $incident_types = [];
    public bool $is_priority = false;
    public bool $submitted = false;
    public ?string $ticket_reference = null;
    public int $company_id;

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

    public function mount(int $companyId): void
    {
        $this->company_id = $companyId;

        $this->departments = Department::where('company_id', $this->company_id)
            ->pluck('name', 'id')
            ->toArray();

        $this->incident_types = IncidentType::pluck('name', 'id')->toArray();
    }

    public function createTicket(): void
    {
        $this->validate();

        if (!empty($this->evidence_files) && collect($this->evidence_files)->contains(fn($file) => ! $file->isValid())) {
            $this->dispatch('toast', message: __('Los archivos aún se están subiendo. Por favor, espera a que termine la carga.'), type: NotificationTypesEnum::WARNING->value);
            return;
        }

        $evidence_paths = [];
        if (!empty($this->evidence_files)) {
            $company = Company::find($this->company_id);
            foreach ($this->evidence_files as $file) {
                $original = $file->getClientOriginalName();
                $file_name = $this->company_id . '_' . Str::replace(' ', '_', trim(Str::lower($company->name))) . '_' . time() . '_' . $original;
                $file_path = $file->storeAs('tickets', $file_name, 'public');
                $evidence_paths[] = $file_path;
            }
        }

        $openStatus = SupportTicketStatus::where('name', 'abierto')->first();

        $trackingUuid = (string) Str::uuid();

        $ticket = SupportTicket::create([
            'company_id' => $this->company_id,
            'department_id' => $this->department_id,
            'incident_type_id' => $this->incident_type_id,
            'support_ticket_status_id' => $openStatus->id,
            'tracking_uuid' => $trackingUuid,
            'created_by_user_id' => null,
            'title' => $this->title,
            'description' => $this->description,
            'contact_email' => $this->contact_email,
            'contact_name' => $this->contact_name,
            'metadata' => [
                'evidences' => $evidence_paths,
            ],
            'is_priority' => $this->is_priority,
            'created_by_ai' => false,
        ]);

        SupportTicketJob::dispatch(
            company: $this->company_id,
            department: $this->department_id,
            incident_type: $this->incident_type_id,
            support_ticket_status: $openStatus->id,
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
        );

        $this->ticket_reference = $trackingUuid;
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
            'ticket_reference'
        ]);
    }

    public function render()
    {
        return view('livewire.ticket.anonymous');
    }
}
