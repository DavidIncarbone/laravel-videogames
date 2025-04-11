<?php

use App\Http\Controllers\Api\videogameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get("videogames", [videogameController::class, "index"]);
Route::get("videogame/{videogame}", [videogameController::class, "show"]);
