<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Questionnaire extends Model
{
    protected $fillable = [
        'questionnaire_category_id',
        'organization_id',
        'company_id',
        'name',
        'description',
        'metadata',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
            'created_at' => 'datetime:d/m/Y H:i',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(QuestionnaireCategory::class, 'questionnaire_category_id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
