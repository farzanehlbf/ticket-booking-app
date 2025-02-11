<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    public function terminals()
    {
        return $this->hasMany(Terminal::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
