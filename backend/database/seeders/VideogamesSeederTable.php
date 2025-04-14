<?php

namespace Database\Seeders;

use Illuminate\Database\type\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Videogame;

class VideogamesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videogames = config("videogames");

        foreach ($videogames as $videogame) {

            $newVideogame = new Videogame;

            $newVideogame->name = $videogame["name"];
            $newVideogame->price = $videogame["price"];
            $newVideogame->year_of_publication = $videogame["year_of_publication"];
            $newVideogame->pegi = $videogame["pegi"];
            $newVideogame->cover = $videogame["cover"];
            $newVideogame->genre_ids = $videogame["genre_ids"];
            $newVideogame->type_ids = $videogame["type_ids"];

            $newVideogame->save();
        }
    }
}
