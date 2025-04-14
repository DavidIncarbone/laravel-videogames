<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\videogameController;
use App\Http\Controllers\Admin\ConsoleController;
use App\Http\Controllers\Admin\GenreController;
use Illuminate\Support\Facades\Route;


Route::get("/", function () {
    return redirect()->route("admin.home");
});

Route::/*middleware(["auth", "verified"])
    ->*/name("admin.")
    ->prefix("admin")
    ->group(function () {
        Route::get('/', function () {
            return view('admin');
        })->name("home");
        Route::resource("profile", ProfileController::class);
        Route::resource("videogames", videogameController::class);
        Route::resource("consoles", ConsoleController::class);
        Route::resource("genres", genreController::class);
    });




require __DIR__ . '/auth.php';
