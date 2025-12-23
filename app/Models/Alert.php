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
        'questionnaire_response_uuid',
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
            'created_at' => 'datetime:d/m/Y H:i',
        ];
    }

    public function alertType(): BelongsTo
    {
        return $this->belongsTo(AlertType::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function questionnaireResponse(): BelongsTo
    {
        return $this->belongsTo(QuestionnaireResponse::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
