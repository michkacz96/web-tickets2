<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerEmail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'email',
        'name',
        'tags'
    ];

    public function customer(): BelongsTo{
        return $this->belongsTo(Customer::class);
    }
}
