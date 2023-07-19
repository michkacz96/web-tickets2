<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'action',
        'type',
        'message',
        'user_id',
    ];

    public function ticket(): BelongsTo{
        return $this->belongsTo(SupportTicket::class, 'ticket_id', 'id');
    }
}