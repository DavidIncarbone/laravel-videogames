<?php

namespace Database\Seeders;

use Illuminate\Database\type\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Genre;

class GenresSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $genres = config("genres");

        foreach ($genres as $genre) {

            $newGenre = new Genre;

            $newGenre->name = $genre;

            $newGenre->save();
        }
    }
}
