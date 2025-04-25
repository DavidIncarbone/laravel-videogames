<?php

namespace Database\Seeders;

use Illuminate\Database\type\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Videogame;
use App\Models\type;

class GenresVideogamesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videogames = config("videogames");
        foreach ($videogames as $videogame) {
            $dbVideogame = Videogame::firstWhere("name", $videogame["name"]);
            $dbVideogame->genres()->attach($videogame["genre_ids"]);
        }
    }
}
