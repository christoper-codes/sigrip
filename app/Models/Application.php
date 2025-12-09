<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'issuing_department_id',
        'executing_department_id',
        'questionnaire_id',
        'auth_required',
        'is_active',
    ];

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
}
