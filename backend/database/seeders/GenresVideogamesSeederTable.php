<?php

namespace Database\Seeders;

use App\Models\Videogame;
use Illuminate\Database\Seeder;

class GenresVideogamesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videogames = config('videogames');
        foreach ($videogames as $videogame) {
            $dbVideogame = Videogame::firstWhere('name', $videogame['name']);
            $dbVideogame->genres()->attach($videogame['genre_ids']);
        }
    }
}
