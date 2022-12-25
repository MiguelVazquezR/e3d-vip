<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductQuotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id',
        'product_id',
        'quantity',
        'is_composed_product',
        'notes',
    ];

    // relationships
    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

}
