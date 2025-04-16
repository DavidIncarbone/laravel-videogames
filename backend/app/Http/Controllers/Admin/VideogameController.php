<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\videogame;
use App\Models\Console;
use App\Models\Genre;
use App\Models\Pegi;
use Illuminate\Support\Facades\Storage;

class VideogameController extends Controller
{

    public function index()
    {

        $videogames = Videogame::all();
        // dd($videogames);

        return view("videogames.index", compact("videogames"));
    }


    public function create()
    {
        $consoles = Console::all();
        $genres = Genre::all();
        $pegis = Pegi::all();

        return view("videogames.create", compact("consoles", "genres", "pegis"));
    }


    public function store(Request $request)

    {

        $request->validate([
            'price' => ['numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
        ]);

        $data = $request->all();
        $newVideogame = new Videogame();

        // dd($data);

        $newVideogame->pegi_id = $data["pegi"];
        $newVideogame->name = $data["name"];
        $newVideogame->price = $data["price"];
        $newVideogame->console_ids = $data["console_ids"];
        $newVideogame->genre_ids = $data["genre_ids"];
        $newVideogame->publisher = $data["publisher"];
        $newVideogame->year_of_publication = $data["year_of_publication"];
        $newVideogame->description = $data["description"];

        if (array_key_exists("cover", $data)) {
            $cover_url = Storage::putFile("videogames", $data["cover"]);
            $newVideogame->cover = $cover_url;
        }

        $newVideogame->save();

        if ($request->has("genre_ids")) {
            $newVideogame->genres()->attach($data["genre_ids"]);
        }
        if ($request->has("console_ids")) {
            $newVideogame->consoles()->attach($data["console_ids"]);
        }
        return redirect()->route("admin.videogames.show", $newVideogame);
    }

    /**
     * Display the specified resource.
     */
    public function show(videogame $videogame)


    {
        return view("videogames.show", compact("videogame"));
    }


    public function edit(videogame $videogame)
    {
        $consoles = Console::all();
        $genres = Genre::all();
        $pegis = Pegi::all();
        return view("videogames.edit", compact("videogame", "consoles", "genres", "pegis"));
    }


    public function update(Request $request, Videogame $videogame)
    {

        $data = $request->all();

        $videogame->pegi_id = $data["pegi"];
        $videogame->name = $data["name"];
        $videogame->console_ids = $data["console_ids"];
        $videogame->genre_ids = $data["genre_ids"];
        $videogame->publisher = $data["publisher"];
        $videogame->year_of_publication = $data["year_of_publication"];
        $videogame->description = $data["description"];


        // dd($data);

        if (array_key_exists("cover", $data)) {

            $cover_url = Storage::putFile("videogames", $data["cover"]);
            $videogame->cover = $cover_url;
        }

        $videogame->update();

        if ($request->has("genre_ids")) {
            $videogame->genres()->sync($data["genre_ids"]);
        } else {
            $videogame->genres()->detach();
        }

        if ($request->has("console_ids")) {
            $videogame->consoles()->sync($data["console_ids"]);
        } else {
            $videogame->consoles()->detach();
        }

        return redirect()->route("admin.videogames.show", $videogame);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(videogame $videogame)
    {
        $videogame->delete();

        return redirect()->route("admin.videogames.index");
    }
}
