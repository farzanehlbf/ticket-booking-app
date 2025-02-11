<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded=[];
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function passengers()
    {
        return $this->belongsToMany(Passenger::class, 'reservation_passengers');
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
