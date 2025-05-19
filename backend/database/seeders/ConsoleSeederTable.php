<?php

namespace Database\Seeders;

use App\Models\Console;
use Illuminate\Database\Seeder;

class ConsoleSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $consoles = config('consoles');

        foreach ($consoles as $console) {

            $newConsole = new Console;

            $newConsole->name = $console['name'];
            $newConsole->logo = $console['logo'];

            $newConsole->save();
        }
    }
}
