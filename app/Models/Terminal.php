<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    use HasFactory;
    public function origin()
    {
        return $this->belongsTo(Origin::class);
    }
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class, 'origin_terminal_id');
    }
}
