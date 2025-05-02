<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Screenshot extends Model
{

    // UNIQUE SLUG

    protected static function booted()

    // CREATE
    {
        static::creating(function ($screenshot) {
            $baseSlug = Str::slug($screenshot->videogame->name);
            $slug = $baseSlug;
            $i = 2;

            while (screenshot::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $i++;
            }

            $screenshot->slug = $slug;
        });

        // UPDATE

        static::updating(function ($screenshot) {
            $baseSlug = Str::slug($screenshot->videogame->name . " " . $screenshot->id);
            $slug = $baseSlug;
            $i = 2;

            while (screenshot::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $i++;
            }

            $screenshot->slug = $slug;
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function videogame()
    {

        return $this->belongsTo(Videogame::class);
    }
}
