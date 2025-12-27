<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'organization_id',
        'image_id',
        'address_id',
        'name',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:d/m/Y H:i',
        ];
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function alerts(): HasMany
    {
        return $this->hasMany(Alert::class);
    }

    public function incidentTypes(): HasMany
    {
        return $this->hasMany(IncidentType::class);
    }

    public function supportTickets(): HasMany
    {
        return $this->hasMany(SupportTicket::class);
    }

    public function getActiveTickets(): int
    {
        return $this->supportTickets()->where('support_ticket_status_id', 1)->count();
    }
}
