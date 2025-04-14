<?php

namespace Database\Seeders;

use Illuminate\Database\type\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\type;

class typeSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $type = config("type");

        foreach ($type as $currenttype) {

            $newtype = new type;

            $newtype->name = $currenttype;

            $newtype->save();
        }
    }
}
