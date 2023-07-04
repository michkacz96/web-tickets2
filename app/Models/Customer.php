<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'full_name',
        'tax_id',
        'licence_number',
    ];

    public function emails(){
        return $this->hasMany(CustomerEmail::class, 'customer_id', 'id');
    }

    public function phones(){
        return $this->hasMany(CustomerPhone::class, 'customer_id', 'id');
    }
}
