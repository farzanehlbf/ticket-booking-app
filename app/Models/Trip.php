<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public function origin()
    {
        return $this->belongsTo(Origin::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function terminal()
    {
        return $this->belongsTo(Terminal::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
