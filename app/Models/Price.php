<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'product_user_id'];

    // relationships
    public function productUser()
    {
        return $this->belongsTo(ProductUser::class);
    }
}
