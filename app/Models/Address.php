<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    protected $fillable = [
        'address_line',
        'zip_code',
        'phone',
        'email',
        'description',
        'metadata',
    ];

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }
}
