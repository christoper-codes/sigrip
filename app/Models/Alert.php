<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alert extends Model
{
    protected $fillable = [
        'alert_type_id',
        'company_id',
        'department_id',
        'application_id',
        'questionnaire_response_id',
        'user_id',
        'name',
        'subject',
        'ai_response',
        'risk_level',
        'risk_score',
        'read_by_user',
        'read_by_department',
        'is_active',
    ];

    public function casts(): array
    {
        return [
            'ai_response' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function alertType(): BelongsTo
    {
        return $this->belongsTo(AlertType::class);
    }
}
