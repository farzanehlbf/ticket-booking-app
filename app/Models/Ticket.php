<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded=[];
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // ارتباط با مسافر
    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    // ارتباط با سفر
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
