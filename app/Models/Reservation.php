<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function reservationPassengers()
    {
        return $this->hasMany(ReservationPassenger::class);
    }
}
