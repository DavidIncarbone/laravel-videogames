<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Screenshot;

class ScreenshotsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $screenshots = config('screenshots');

        foreach ($screenshots as $screenshot) {

            $newScreenshot = new Screenshot;

            $newScreenshot->videogame_id = $screenshot['videogame_id'];
            $newScreenshot->url = $screenshot['url'];

            $newScreenshot->save();
        }
    }
}
