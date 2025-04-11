<?php

namespace App\Http\Controllers\Api;

use App\Models\videogame;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class videogameController extends Controller
{
    public function index()
    {

        $videogames = videogame::all();



        return response()->json([
            "success" => true,
            "data" => $videogames
        ]);
    }

    public function show(videogame $videogame)
    {

        $videogame->load("genres");

        return response()->json([
            "success" => true,
            "data" => $videogame
        ]);
    }
}
