<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportTicket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'category_id',
        'created_by',
        'closed_by',
        'description',
        'customer_contact_type',
        'customer_contact',
    ];

    public function category(): BelongsTo{
        return $this->belongsTo(TicketCategory::class);
    }

    public function createdBy(): BelongsTo{
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function closedBy(): BelongsTo{
        return $this->belongsTo(User::class, 'closed_by', 'id');
    }
}
