<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellOrderedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'status',
        'notes',
        'sell_order_id',
        'product_id',
    ];

    // relationships
    public function sellOrder()
    {
        return $this->belongsTo(SellOrder::class);
    }
}
