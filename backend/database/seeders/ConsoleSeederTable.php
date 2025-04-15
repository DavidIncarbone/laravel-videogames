<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Console;

class ConsoleSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $consoles = config("consoles");

        foreach ($consoles as $console) {

            $newConsole = new Console;

            $newConsole->name = $console;
            $newConsole->logo =

                $newConsole->save();
        }
    }
}
