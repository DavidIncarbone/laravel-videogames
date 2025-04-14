<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Videogame;


class ConsoleVideogameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $videogames = Videogame::all();

        foreach ($videogames as $videogame) {

            $videogame->consoles()->attach($videogame["console_ids"]);
        };
    }
}
