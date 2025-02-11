<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationPassenger extends Model
{
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }
}
