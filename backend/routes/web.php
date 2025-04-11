<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\videogameController;
use App\Http\Controllers\Admin\consoleController;
use App\Http\Controllers\Admin\genreController;
use Illuminate\Support\Facades\Route;


Route::get("/", function () {
    return redirect()->route("admin.home");
});

Route::middleware(["auth", "verified"])
    ->name("admin.")
    ->prefix("admin")
    ->group(function () {
        Route::get('/', function () {
            return view('admin');
        })->name("home");
        Route::resource("profile", ProfileController::class);
        Route::resource("videogames", videogameController::class);
        Route::resource("console", consoleController::class);
        Route::resource("genres", genreController::class);
    });




require __DIR__ . '/auth.php';
