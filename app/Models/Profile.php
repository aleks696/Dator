<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'photo',
        'name',
        'age',
        'gender',
        'phone',
        'search_purpose',
        'city',
        'hobbies',
    ];

    protected $hidden = [
        'id',
        'user_id',
        'created_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
