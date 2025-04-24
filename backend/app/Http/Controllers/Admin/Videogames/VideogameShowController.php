<?php

namespace App\Http\Controllers\Admin\Videogames;

use App\Http\Controllers\Controller;
use App\Models\Videogame;
use Illuminate\Support\Str;

class VideogameShowController extends Controller
{
    public function destroy(Videogame $videogame)
    {

        $name = $videogame->name;

        $videogame->delete();

        toastr()->success("<span class='fw-bold'>" . Str::limit($name, 20) . "</span> è stato eliminato con successo");

        return redirect()->route("admin.videogames.index");
    }
}
