<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Screenshot extends Model
{
    public function videogame()
    {

        return $this->belongsTo(Videogame::class);
    }
}
