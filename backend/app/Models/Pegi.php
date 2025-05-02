<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Pegi extends Model
{

    // UNIQUE SLUG

    protected static function booted()

    // CREATE
    {
        static::creating(function ($pegi) {
            $baseSlug = Str::slug("PEGI " . $pegi->age);
            $slug = $baseSlug;
            $i = 2;

            while (Pegi::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $i++;
            }

            $pegi->slug = $slug;
        });

        // UPDATE

        static::updating(function ($pegi) {
            $baseSlug = Str::slug("PEGI " . $pegi->age);
            $slug = $baseSlug;
            $i = 2;

            while (Pegi::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $i++;
            }

            $pegi->slug = $slug;
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function videogames()
    {

        return $this->hasMany(Videogame::class);
    }
}
