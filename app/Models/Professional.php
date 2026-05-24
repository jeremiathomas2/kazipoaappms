<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $fillable = [
        'name',
        'service',
        'region',
        'rating',
        'jobs_count',
        'is_verified',
        'avatar_color',
        'status',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
