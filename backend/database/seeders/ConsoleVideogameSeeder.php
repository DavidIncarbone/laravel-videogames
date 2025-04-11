<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Videogame;
use App\Models\Console;

class ConsoleVideogameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $videogames = Videogame::all();

        foreach ($videogames as $videogame) {

            $videogame->console()->attach($videogame["console_ids"]);
        };
    }
}
