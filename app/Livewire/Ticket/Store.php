<?php

namespace App\Livewire\Ticket;

use App\Enums\NotificationTypesEnum;
use App\Jobs\SupportTicketJob;
use App\Models\IncidentType;
use App\Models\SupportTicket;
use App\Models\SupportTicketStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Store extends Component
{
    use WithFileUploads;

    public ?array $departments = [];
    public ?array $incident_types = [];
    public bool $is_priority = true;
    public bool $is_anonymous = false;

    #[Validate(['required', 'integer'])]
    public ?int $department = null;

    #[Validate(['required', 'integer'])]
    public ?int $incident_type = null;

    #[Validate(['required', 'string', 'min:3', 'max:255'])]
    public ?string $title = null;

    #[Validate(['required', 'string', 'min:3'])]
    public ?string $description = null;

    #[Validate(['nullable', 'array'])]
    public $evidence_files = [];

    public function mount(): void
    {
        $this->departments = Auth::user()->company?->departments->toArray() ?? [];
        $this->incident_types = IncidentType::all()->toArray();
    }

    public function submit(): void
    {
        $this->validate();
        if (!$this->evidence_files || collect($this->evidence_files)->contains(fn($file) => ! $file->isValid())) {
            $this->dispatch('toast', message: __('Los archivos aún se están subiendo. Por favor, espera a que termine la carga.'), type: 'warning');
            return;
        }

        $evidence_paths = [];
        foreach ($this->evidence_files as $file) {
            $original = $file->getClientOriginalName();
            $file_name = Auth::user()->company_id . '_' . Str::replace(' ', '_', trim(Str::lower(Auth::user()->company->name))) . '_' . time() . '_' . $original;
            $file_path = $file->storeAs('tickets', $file_name, 'public');
            $evidence_paths[] = $file_path;
        }

        SupportTicketJob::dispatch(
            company: Auth::user()->company?->id,
            department: $this->department,
            incident_type: $this->incident_type,
            support_ticket_status: SupportTicketStatus::where('name', 'abierto')->first()->id,
            created_by_user: $this->is_anonymous ? null : Auth::user()->id,
            title: $this->title,
            description: $this->description,
            is_priority: $this->is_priority,
            is_anonymous: $this->is_anonymous,
            evidence_files: $evidence_paths,
        );

        $this->dispatch('toast', message: __('Ticket creado correctamente. Tomara unos segundos en procesarse.'), type: NotificationTypesEnum::SUCCESS->value);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.ticket.store');
    }
}
