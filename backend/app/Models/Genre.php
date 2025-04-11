<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    public function videogames()
    {
        return $this->belongsToMany(videogame::class);
    }
}
