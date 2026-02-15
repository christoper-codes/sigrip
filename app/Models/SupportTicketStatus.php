<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupportTicketStatus extends Model
{
    protected $fillable = [
        'name',
        'description',
        'color',
        'is_active',
    ];

    public function supportTickets(): HasMany
    {
        return $this->hasMany(SupportTicket::class);
    }
}
