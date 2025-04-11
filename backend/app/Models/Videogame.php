<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class videogame extends Model
{

    protected $casts = [
        'console_ids' => 'array',
    ];


    public function console()
    {
        return $this->belongsToMany(Console::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
