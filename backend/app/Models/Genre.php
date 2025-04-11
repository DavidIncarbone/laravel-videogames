<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class genre extends Model
{
    public function videogames()
    {
        return $this->belongsToMany(Videogame::class);
    }
}
