<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $guarded=[];
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_passengers')
        ->withPivot('leader')  // فیلد leader از جدول میانه
        ->withTimestamps();
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
