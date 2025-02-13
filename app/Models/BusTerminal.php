<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusTerminal extends Model
{
    use HasFactory;
    protected $fillable = ['origin_id', 'destination_id', 'name', 'terminal_code'];

    // ارتباط با سفرها
    // رابطه پولیمورفیک برای سفرهای مبدا
    public function tripsAsOrigin()
    {
        return $this->morphMany(Trip::class, 'origin_terminalable');
    }

    // رابطه پولیمورفیک برای سفرهای مقصد
    public function tripsAsDestination()
    {
        return $this->morphMany(Trip::class, 'destination_terminalable');
    }
    public function origin()
    {
        return $this->belongsTo(Origin::class, 'origin_id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
}
