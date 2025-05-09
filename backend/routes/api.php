<?php

use App\Http\Controllers\Api\VideogameController;
use App\Http\Controllers\Api\ConsoleController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\PegiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// VIDEOGAMES

Route::get("videogames", [VideogameController::class, "index"]);
Route::get("videogame/{videogame}", [VideogameController::class, "show"]);
Route::get("videogames/homepage", [VideogameController::class, "homePage"]);

// CONSOLES

Route::get("consoles", [ConsoleController::class, "index"]);

// GENRES

Route::get("genres", [GenreController::class, "index"]);

// PEGIS

Route::get("pegis", [PegiController::class, "index"]);
