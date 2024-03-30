<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'user_id',
        'rating',
        'comment',
        'coordinate',
        'coordinate_info',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
