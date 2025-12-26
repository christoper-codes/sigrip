<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncidentType extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'description',
        'is_active',
        'is_base',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
