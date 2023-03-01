<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_id',
        'additional_attributes',
        'is_composed_product',
        'user_id',
    ];

    // relationships
    public function prices() 
    {
        return $this->hasMany(Price::class);
    }

    public function currentPrice()
    {
        return $this->hasOne(Price::class)->latest();
    }

}
