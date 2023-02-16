<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    // constants
    const STATUS_IN_CHECKING = 0,
          STATUS_GENERATED = 1,
          STATUS_APPROVED = 2;

    protected $fillable = [
        'user_id',
        'seller_id',
        'released_at',
        'status',
        'freight_cost',
        'tooling_cost',
        'currency',
        'first_production_days',
    ];

    protected $dates = ['released_at'];

    // relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(ProductQuotation::class);
    }
    
}
