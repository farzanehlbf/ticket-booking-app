<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    public function reservationPassengers()
    {
        return $this->hasMany(ReservationPassenger::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
