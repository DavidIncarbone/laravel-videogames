<?php

namespace Database\Seeders;

use App\Models\Pegi;
use Illuminate\Database\Seeder;

class PegisSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $pegis = config('pegis');

        foreach ($pegis as $pegi) {

            $newPegi = new Pegi;
            $newPegi->age = $pegi;
            $newPegi->logo = 'img/pegis/logos/pegi'.$pegi.'.png';

            $newPegi->save();
        }
    }
}
