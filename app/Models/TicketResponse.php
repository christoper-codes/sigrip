<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketResponse extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'support_ticket_id',
        'user_id',
        'metadata',
        'is_active',
    ];

    public function casts(): array
    {
        return [
            'metadata' => 'array',
            'created_at' => 'datetime:d/m/Y H:i',
            'deleted_at' => 'datetime:d/m/Y H:i',
        ];
    }

    public function supportTicket(): BelongsTo
    {
        return $this->belongsTo(SupportTicket::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
