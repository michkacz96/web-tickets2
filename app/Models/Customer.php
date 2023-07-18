<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'full_name',
        'tax_id',
        'licence_number',
    ];

    public function emails(): HasMany{
        return $this->hasMany(CustomerEmail::class);
    }

    public function phones(): HasMany{
        return $this->hasMany(CustomerPhone::class, 'customer_id', 'id');
    }

    public function tickets(): HasMany{
        return $this->hasMany(SupportTicket::class, 'customer_id', 'id');
    }
}
