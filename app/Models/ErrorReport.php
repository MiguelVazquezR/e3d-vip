<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'content',
        'user_id',
        'is_error',
        'is_read',
    ];
}
