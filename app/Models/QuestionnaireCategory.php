<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionnaireCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function questionnaires(): HasMany
    {
        return $this->hasMany(Questionnaire::class, 'questionnaire_category_id');
    }
}
