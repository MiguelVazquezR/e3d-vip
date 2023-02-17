<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class NewProductRequest extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'description',
        'authorized_at',
        'user_id',
    ];

    protected $dates = [
        'authorized_at',
    ];

    //relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
