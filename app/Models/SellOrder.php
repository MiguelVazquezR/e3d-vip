<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SellOrder extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'freight_cost',
        'status',
        'notes',
        'shipping_company',
        'tracking_guide',
        'user_id',
        'requirement_date',
        'received_at',
    ];

    protected $dates = ['requirement_date', 'received_at'];

    // relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // query scopes
    public function scopeFilter($query, $filters)
    {
        $query->when($filters["search"], function($query, $search){
            $query->where('id', 'LIKE', "%$search%");
        });
    }

}
