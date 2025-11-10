<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Image extends Model
{
    protected $fillable = [
        'file_path',
        'is_active',
    ];

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }
}
