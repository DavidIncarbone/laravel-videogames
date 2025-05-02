<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Videogame extends Model
{

    // SLUG

    protected static function booted()
    {
        static::creating(function ($videogame) {
            $videogame->slug = Str::slug($videogame->name);
        });

        static::updating(function ($videogame) {
            $videogame->slug = Str::slug($videogame->name);
        });

        // UNIQUE SLUG

        static::creating(function ($videogame) {
            $baseSlug = Str::slug($videogame->name);
            $slug = $baseSlug;
            $i = 2;

            while (Videogame::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $i++;
            }

            $videogame->slug = $slug;
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }



    // FOREIGN

    public function consoles()
    {
        return $this->belongsToMany(Console::class)->withTimestamps();
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class)->withTimestamps();
    }

    public function screenshots()
    {

        return $this->hasMany(Screenshot::class);
    }

    public function pegi()
    {

        return $this->belongsTo(Pegi::class);
    }
}
