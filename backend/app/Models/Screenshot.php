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

            $videogame = Videogame::find($screenshot->videogame_id);
            $baseSlug = Str::slug($videogame?->name . 'screenshot' ?? 'screenshot');
            $slug = $baseSlug;
            $i = 2;

            while (Screenshot::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $i++;
            }

            $screenshot->slug = $slug;
        });

        // UPDATE

        static::updating(function ($screenshot) {

            $videogame = Videogame::find($screenshot->videogame_id);
            $baseSlug = Str::slug(($videogame?->name . 'screenshot' ?? 'screenshot') . " " . $screenshot->id);
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
