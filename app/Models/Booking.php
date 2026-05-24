<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'client_id',
        'professional_id',
        'service_type',
        'location',
        'date',
        'time',
        'type',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
