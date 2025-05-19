<?php

namespace Database\Seeders;

use App\Models\Pegi;
use App\Models\Videogame;
use Illuminate\Database\Seeder;

class VideogamesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videogames = config('videogames');

        foreach ($videogames as $videogame) {

            $newVideogame = new Videogame;

            $newVideogame->name = $videogame['name'];
            $newVideogame->price = $videogame['price'];
            $newVideogame->year_of_publication = $videogame['year_of_publication'];
            $pegi = Pegi::where('age', $videogame['pegi'])->first();
            $newVideogame->pegi_id = $pegi->id;
            $newVideogame->cover = $videogame['cover'];
            $newVideogame->description = $videogame['description'];
            $newVideogame->publisher = $videogame['publisher'];
            $newVideogame->placeholder = $videogame['placeholder'];
            $newVideogame->save();
        }
    }
}
