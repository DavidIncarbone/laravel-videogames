<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videogame extends Model
{

    protected $casts = [
        'type_ids' => 'array',
        'genre_ids' => 'array'
    ];


    public function consoles()
    {
        return $this->belongsToMany(Console::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
