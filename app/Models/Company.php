<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'organization_id',
        'image_id',
        'address_id',
        'name',
        'description',
    ];
}
