<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    public function origin()
    {
        return $this->belongsTo(Origin::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
