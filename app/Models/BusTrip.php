<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusTrip extends Model
{
    use HasFactory;
    protected $fillable = ['trip_id','terminal_id','bus_number', 'bus_company', 'seat_count',];
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
