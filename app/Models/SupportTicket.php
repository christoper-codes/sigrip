<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportTicket extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'department_id',
        'incident_type_id',
        'support_ticket_status_id',
        'alert_id',
        'alert_uuid',
        'tracking_uuid',
        'created_by_user_id',
        'assigned_to_user_id',
        'title',
        'description',
        'contact_email',
        'contact_name',
        'metadata',
        'is_priority',
        'created_by_ai',
        'is_active',
        'resolved_at',
    ];

    public function casts(): array
    {
        return [
            'metadata' => 'array',
            'created_at' => 'datetime:d/m/Y H:i',
            'resolved_at' => 'datetime:d/m/Y H:i',
            'deleted_at' => 'datetime:d/m/Y H:i',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function incidentType(): BelongsTo
    {
        return $this->belongsTo(IncidentType::class);
    }

    public function supportTicketStatus(): BelongsTo
    {
        return $this->belongsTo(SupportTicketStatus::class);
    }

    public function alert(): BelongsTo
    {
        return $this->belongsTo(Alert::class);
    }

    public function alertByUuid(): BelongsTo
    {
        return $this->belongsTo(Alert::class, 'alert_uuid', 'uuid');
    }

    public function createdByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function assignedToUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function ticketResponses(): HasMany
    {
        return $this->hasMany(TicketResponse::class);
    }
}
