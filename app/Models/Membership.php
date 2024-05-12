<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'membership',
        'swipes_amount',
        'start_date',
    ];

    protected $hidden = [
        'end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
