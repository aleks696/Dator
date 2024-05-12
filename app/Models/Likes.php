<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_liked_id',
        'liked_user_id',
    ];

    protected $hidden = [
        'is_matched_likes',
    ];
}
