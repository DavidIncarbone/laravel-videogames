<?php

namespace Database\Seeders;

use Illuminate\Database\type\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Videogame;
use App\Models\type;

class typeVideogameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $videogames = Videogame::all();

        foreach ($videogames as $videogame) {

            $videogame->type()->attach($videogame["type_ids"]);
        };
    }
}
