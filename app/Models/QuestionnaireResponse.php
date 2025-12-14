<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionnaireResponse extends Model
{
    protected $fillable = [
        'application_id',
        'questionnaire_id',
        'user_id',
        'department_id',
        'response_data',
        'ai_response',
        'average_score',
        'risk_level',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'response_data' => 'array',
            'ai_response' => 'array',
        ];
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function questionnaire(): BelongsTo
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
