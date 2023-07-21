<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketDetail extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'ticket_id',
        'action',
        'message',
        'user_id',
    ];

    public function ticket(): BelongsTo{
        return $this->belongsTo(SupportTicket::class, 'ticket_id', 'id');
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}