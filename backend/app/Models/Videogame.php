<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videogame extends Model
{

    protected $fillable = ['pegi_id', 'name', 'publisher', 'year_of_publication', 'description', 'cover', 'console_ids', 'genre_ids'];

    protected $casts = [
        'console_ids' => 'array',
        'genre_ids' => 'array'
    ];


    public function consoles()
    {
        return $this->belongsToMany(Console::class)->withTimestamps();
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class)->withTimestamps();
    }

    public function pegi()
    {

        return $this->belongsTo(Pegi::class);
    }
}
