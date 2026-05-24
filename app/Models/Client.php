<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'contact',
        'region',
        'bookings_count',
        'last_active',
        'status',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
