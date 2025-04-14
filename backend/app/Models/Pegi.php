<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegi extends Model
{
    public function videogames()
    {

        return $this->hasMany(Videogame::class);
    }
}
