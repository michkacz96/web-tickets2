<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportTicket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'category_id',
        'created_by',
        'closed_by',
        'priority',
        'description',
        'customer_contact_type',
        'customer_contact',
    ];

    private array $priorities = [
        'L' => 'Low',
        'M' => 'Medium',
        'H' => 'High',
        'U' => 'Urgent',
    ];
    
    /**
     * returns full name of priority from priorities table
     * @return string full name of priority
     */
    public function priority(): string{
        return $this->priorities[$this->priority];
    }

    public function category(): BelongsTo{
        return $this->belongsTo(TicketCategory::class);
    }

    public function createdBy(): BelongsTo{
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function closedBy(): BelongsTo{
        return $this->belongsTo(User::class, 'closed_by', 'id');
    }

    public function customer(): BelongsTo{
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function ticketDetails(): HasMany{
        return $this->hasMany(TicketDetail::class, 'ticket_id', 'id')->orderBy('created_at', 'DESC');
    }
}
