<?php

namespace App\Models;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class genre extends Model
{

    // UNIQUE SLUG

    protected static function booted()

    // CREATE
    {
        static::creating(function ($genre) {
            $baseSlug = Str::slug($genre->name);
            $slug = $baseSlug;
            $i = 2;

            while (Genre::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $i++;
            }

            $genre->slug = $slug;
        });

        // UPDATE

        static::updating(function ($genre) {
            $baseSlug = Str::slug($genre->name);
            $slug = $baseSlug;
            $i = 2;

            while (Genre::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $i++;
            }

            $genre->slug = $slug;
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
