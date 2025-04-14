<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pegi;


class PegisSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $pegis = config("pegis");

        foreach ($pegis as $pegi) {

            $newPegi = new Pegi;
            $newPegi->age = $pegi;

            $newPegi->save();
        }
    }
}
