<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {

        $genres = Genre::all();
        $genresCount = Genre::count();

        return response()->json([
            "success" => true,
            "count" => $genresCount,
            "data" => $genres
        ]);
    }
}
