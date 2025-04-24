<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Videogames\VideogameController;
use App\Http\Controllers\Admin\Videogames\VideogameShowController;
use App\Http\Controllers\Admin\ConsoleController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\PegiController;
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
        Route::resource("videogames", VideogameController::class);
        Route::delete("videogames/show/{videogame}", [VideogameShowController::class, "destroy"])->name("videogames.show.destroy");
        Route::resource("consoles", ConsoleController::class);
        Route::resource("genres", GenreController::class);
        Route::resource("pegis", PegiController::class);
    });




require __DIR__ . '/auth.php';
