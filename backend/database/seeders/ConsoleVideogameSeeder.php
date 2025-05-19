<?php

namespace Database\Seeders;

use App\Models\Videogame;
use Illuminate\Database\Seeder;

class ConsoleVideogameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $videogames = Videogame::all();

        $videogames = config('videogames');
        foreach ($videogames as $videogame) {
            $dbVideogame = Videogame::firstWhere('name', $videogame['name']);
            $dbVideogame->consoles()->attach($videogame['console_ids']);
        }
    }
}
