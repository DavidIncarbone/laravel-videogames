<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\VideogameController;
use App\Http\Controllers\Admin\ConsoleController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\PegiController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;


Route::/*middleware(/["auth", "verified"])
    ->*/name("admin.")
    ->prefix("admin")
    ->group(function () {

        Route::get("/", function () {
            return redirect()->route('admin.dashboard');
        });

        // DASHBOARD

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name("dashboard");

        // PROFILE EDIT

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        // VIDEOGAMES

        Route::resource("videogames", VideogameController::class);
        Route::delete("videogames/all/destroy", [VideogameController::class, "destroyAll"])->name("videogames.destroyAll");
        Route::delete("videogames/selected/destroy", [VideogameController::class, "destroySelected"])->name("videogames.destroySelected");
        Route::delete("videogames/show/{videogame:slug}", [VideogameController::class, "destroyShow"])->name("videogames.show.destroy");

        // CONSOLES

        Route::resource("consoles", ConsoleController::class);
        Route::delete("consoles/all/destroy", [ConsoleController::class, "destroyAll"])->name("consoles.destroyAll");
        Route::delete("consoles/selected/destroy", [ConsoleController::class, "destroySelected"])->name("consoles.destroySelected");

        // GENRES

        Route::resource("genres", GenreController::class);
        Route::delete("genres/all/destroy", [GenreController::class, "destroyAll"])->name("genres.destroyAll");
        Route::delete("genres/selected/destroy", [GenreController::class, "destroySelected"])->name("genres.destroySelected");

        // PEGIS

        Route::resource("pegis", PegiController::class);
        Route::delete("pegis/all/destroy", [PegiController::class, "destroyAll"])->name("pegis.destroyAll");
        Route::delete("pegis/selected/destroy", [PegiController::class, "destroySelected"])->name("pegis.destroySelected");
    });







require __DIR__ . '/auth.php';
