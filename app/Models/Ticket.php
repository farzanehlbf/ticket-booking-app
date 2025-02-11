<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function reservationPassenger()
    {
        return $this->belongsTo(ReservationPassenger::class);
    }
}
