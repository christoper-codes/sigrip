<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'issuing_department_id',
        'executing_department_id',
        'questionnaire_id',
        'slug',
        'auth_required',
        'start_date',
        'expiration_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:d/m/Y H:i',
            'start_date' => 'date',
            'expiration_date' => 'date',
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
}
