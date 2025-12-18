<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlertType extends Model
{
    protected $fillable = [
        'name',
        'color',
        'description',
        'is_active',
    ];

    public function alerts(): HasMany
    {
        return $this->hasMany(Alert::class);
    }
}
