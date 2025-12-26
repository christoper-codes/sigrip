<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicketStatus extends Model
{
    protected $fillable = [
        'name',
        'description',
        'color',
        'is_active',
    ];
}
