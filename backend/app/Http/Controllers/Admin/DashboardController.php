<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Console;
use App\Models\Genre;
use App\Models\Pegi;
use App\Models\Screenshot;
use App\Models\Videogame;

class DashboardController extends Controller
{
    public function index()
    {

        $videogamesCount = Videogame::all()->count();
        $consolesCount = Console::all()->count();
        $genresCount = Genre::all()->count();
        $pegisCount = PEGI::all()->count();
        $screenshotsCount = Screenshot::all()->count();

        $itemsCount = [
            [
                'name' => 'Videogiochi',
                'url' => 'admin.videogames.index',
                'count' => $videogamesCount,
            ],
            [
                'name' => 'Console',
                'url' => 'admin.consoles.index',
                'count' => $consolesCount,
            ],
            [
                'name' => 'Generi',
                'url' => 'admin.genres.index',
                'count' => $genresCount,
            ],
            [
                'name' => 'PEGI',
                'url' => 'admin.pegis.index',
                'count' => $pegisCount,
            ],
            [
                'name' => 'Screenshots',
                'url' => 'admin.screenshots.index',
                'count' => $screenshotsCount,
            ],
        ];

        return view('dashboard', compact('itemsCount'));
    }
}
