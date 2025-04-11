<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class videogame extends Model
{
    public function console()
    {
        return $this->belongsTo(console::class);
    }

    public function genres()
    {
        return $this->belongsToMany(genre::class);
    }
}
