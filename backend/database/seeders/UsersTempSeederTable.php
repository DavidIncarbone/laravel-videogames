<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTempSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newUser = new User;

        $newUser->name = "David";
        $newUser->email = "dejan_91@outlook.it";
        $newUser->password = '$2y$12$tSPNP.YsWmhmxErYOfW1Oe21iBD0Cc7Z3xtc1iVBKfHdJENLMJI5O';
        $newUser->remember_token = '389TRxaG7Ac4kTMInVVbn0lwlvN1ASJbwEhpqgZT0O9VEx0dO57m9l95Obp2';
        $newUser->save();
    }
}
