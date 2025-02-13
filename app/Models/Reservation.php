<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'search_id',
        'passengers_count',
        'chair_numbers',
        'expiry_time',
        'status',
        'trip_id',
    ];
    protected $casts = [
    'chair_numbers' => 'array',
    ];


    public function search()
    {
        return $this->belongsTo(Search::class);
    }


    public function isExpired()
    {
        return $this->expiry_time < now();
    }
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function passengers()
    {
        return $this->belongsToMany(Passenger::class, 'reservation_passengers')
        ->withPivot('leader')  // فیلد leader از جدول میانه
        ->withTimestamps();
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
