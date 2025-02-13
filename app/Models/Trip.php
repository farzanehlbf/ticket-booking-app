<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['origin_id', 'destination_id', 'terminal_id', 'transport_type_id', 'date',];

    public function origin()
    {
        return $this->belongsTo(Origin::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function transportType()
    {
        return $this->belongsTo(TransportType::class);
    }
    // رابطه پولیمورفیک برای ترمینال مبدا
    public function originTerminalable()
    {
        return $this->morphTo('origin_terminalable');
    }

    // رابطه پولیمورفیک برای ترمینال مقصد
    public function destinationTerminalable()
    {
        return $this->morphTo('destination_terminalable');
    }


    public function scopeSearch($query, $originCityCode = null, $originTerminalCode = null, $originName = null, $destinationCityCode = null, $destinationTerminalCode = null, $destinationName = null, $date = null, $transportType = null)
    {
        $query->when($originCityCode, function ($query) use ($originCityCode) {
            $query->whereHas('origin', function ($query) use ($originCityCode) {
                $query->where('city_code', '=', $originCityCode);
            });
        })
            ->when($originTerminalCode, function ($query) use ($originTerminalCode) {
                // جستجو در ترمینال مبدا
                $query->whereHas('originTerminalable', function ($query) use ($originTerminalCode) {
                    $query->where('terminal_code', '=', $originTerminalCode);
                });
            })
            ->when($originName, function ($query) use ($originName) {
                $query->whereHas('origin', function ($query) use ($originName) {
                    $query->where('name', 'like', "%$originName%");
                });
            })
            // جستجو براساس city_code یا terminal_code برای مقصد
            ->when($destinationCityCode, function ($query) use ($destinationCityCode) {
                $query->whereHas('destination', function ($query) use ($destinationCityCode) {
                    $query->where('city_code', '=', $destinationCityCode);
                });
            })
            ->when($destinationTerminalCode, function ($query) use ($destinationTerminalCode) {
                // جستجو در ترمینال مقصد
                $query->whereHas('destinationTerminalable', function ($query) use ($destinationTerminalCode) {
                    $query->where('terminal_code', '=', $destinationTerminalCode);
                });
            })
            ->when($destinationName, function ($query) use ($destinationName) {
                $query->whereHas('destination', function ($query) use ($destinationName) {
                    $query->where('name', 'like', "%$destinationName%");
                });
            })
            ->when($date, function ($query) use ($date) {
                $query->whereDate('date', '=', $date);
            });

        if ($transportType) {
            $query->where('transport_type_id', $transportType);
        }

        return $query;
    }


}
