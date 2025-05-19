<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Console extends Model
{
    // UNIQUE SLUG

    protected static function booted()

    // CREATE
    {
        static::creating(function ($console) {
            $baseSlug = Str::slug($console->name);
            $slug = $baseSlug;
            $i = 2;

            while (Console::where('slug', $slug)->exists()) {
                $slug = $baseSlug.'-'.$i++;
            }

            $console->slug = $slug;
        });

        // UPDATE

        static::updating(function ($console) {
            $baseSlug = Str::slug($console->name);
            $slug = $baseSlug;
            $i = 2;

            while (Console::where('slug', $slug)->exists()) {
                $slug = $baseSlug.'-'.$i++;
            }

            $console->slug = $slug;
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function videogames()
    {

        return $this->belongsToMany(Videogame::class);
    }
}
