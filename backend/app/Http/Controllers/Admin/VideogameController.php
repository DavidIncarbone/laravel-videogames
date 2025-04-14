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

        $videogames = videogame::all();
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

        $newVideogame->name = $data["name"];
        $newVideogame->pegi_id = $data["pegi"];
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
        return view("videogames.edit", compact("videogame", "consoles", "genres"));
    }


    public function update(Request $request, videogame $videogame)
    {

        $data = $request->all();

        $videogame->name = $data["name"];
        $videogame->type_id = $data["type_id"];
        $videogame->customer = $data["customer"];
        $videogame->period = $data["period"];
        $videogame->summary = $data["summary"];
        $videogame->link = $data["link"];

        // dd($data);

        if (array_key_exists("image", $data)) {

            if ($videogame->image) {

                Storage::delete($videogame->image);
                $img_url = Storage::putFile("videogames", $data["image"]);
                $videogame->image = $img_url;
            } else {
                $img_url = Storage::putFile("videogames", $data["image"]);
                $videogame->image = $img_url;
            }
        } else {

            Storage::delete($videogame->image);
            $videogame->image = null;
        }

        $videogame->update();

        if ($request->has("genres")) {
            $videogame->genres()->sync($data["genres"]);
        } else {
            $videogame->genres()->detach();
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
