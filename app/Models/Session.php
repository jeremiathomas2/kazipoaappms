<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'kazi_sessions';

    protected $fillable = [
        'booking_id',
        'start_time',
        'duration',
        'status',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
