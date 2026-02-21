<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionnaireResponse extends Model
{
    protected $fillable = [
        'uuid',
        'application_id',
        'questionnaire_id',
        'user_id',
        'department_id',
        'employee_data',
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
            'employee_data' => 'array',
        ];
    }

    protected function aiResponse(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (is_array($value)) {
                    return $value;
                }

                if (is_string($value)) {
                    return json_decode($value, true) ?? [];
                }

                return [];
            },
            set: function ($value) {
                return is_array($value)
                    ? json_encode($value, JSON_UNESCAPED_UNICODE)
                    : $value;
            }
        );
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

    public function alerts(): HasMany
    {
        return $this->hasMany(Alert::class);
    }
}
