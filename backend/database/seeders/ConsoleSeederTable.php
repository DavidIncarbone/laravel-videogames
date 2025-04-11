<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Console;

class ConsoleSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $console = config("console");

        foreach ($console as $currentConsole) {

            $newConsole = new Console;

            $newConsole->name = $currentConsole;

            $newConsole->save();
        }
    }
}
