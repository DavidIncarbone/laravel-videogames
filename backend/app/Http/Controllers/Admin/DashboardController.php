<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Videogame;
use App\Models\Console;
use App\Models\Genre;
use App\Models\Pegi;

class DashboardController extends Controller
{
    public function index()
    {

        $videogamesCount = Videogame::all()->count();
        $consolesCount = Console::all()->count();
        $genresCount = Genre::all()->count();
        $pegisCount = PEGI::all()->count();


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
        ];

        return view('dashboard', compact('itemsCount'));
    }
}
