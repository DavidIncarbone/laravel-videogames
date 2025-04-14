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
        $videogames = Videogame::all();

        foreach ($videogames as $videogame) {
            $videogame->genres()->attach($videogame["genre_ids"]);
        }
    }
}
