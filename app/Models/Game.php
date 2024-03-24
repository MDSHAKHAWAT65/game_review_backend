<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'img_url',
        'status',
    ];

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function avg() {
        $avg = $this->ratings->count() > 0 ? $this->ratings->sum(fn($rating) => $rating->rating) / $this->ratings->count() : 0;
        return number_format($avg, 1);
    }


}
