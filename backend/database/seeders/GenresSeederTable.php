<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenresSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $genres = config('genres');

        foreach ($genres as $genre) {

            $newGenre = new Genre;

            $newGenre->name = $genre;

            $newGenre->save();
        }
    }
}
