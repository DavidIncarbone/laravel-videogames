<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class videogame extends Model
{
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Technology::class);
    }
}
