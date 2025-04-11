<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\videogameController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\TechnologyController;
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
        Route::resource("console", TypeController::class);
        Route::resource("genres", TechnologyController::class);
    });




require __DIR__ . '/auth.php';
