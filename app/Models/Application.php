<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'issuing_department_id',
        'executing_department_id',
        'questionnaire_id',
        'slug',
        'auth_required',
        'employee_data_required',
        'start_date',
        'expiration_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:d/m/Y',
            'start_date' => 'datetime:d/m/Y',
            'expiration_date' => 'datetime:d/m/Y',
        ];
    }

    public function issuingDepartment(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'issuing_department_id');
    }

    public function executingDepartment(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'executing_department_id');
    }

    public function questionnaire(): BelongsTo
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'application_user')
            ->withPivot('is_active')
            ->withTimestamps();
    }

    public function questionnaireResponses(): HasMany
    {
        return $this->hasMany(QuestionnaireResponse::class);
    }

    public function alerts(): HasMany
    {
        return $this->hasMany(Alert::class);
    }
}
