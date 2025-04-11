<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\videogame;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;

class videogameController extends Controller
{

    public function index()
    {

        $videogames = videogame::all();
        // dd($videogames);

        return view("videogames.index", compact("videogames"));
    }


    public function create()
    {
        $console = Type::all();
        $genres = Technology::all();

        return view("videogames.create", compact("console", "genres"));
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $newvideogame = new videogame();


        $newvideogame->name = $data["name"];
        $newvideogame->type_id = $data["type_id"];
        $newvideogame->customer = $data["customer"];
        $newvideogame->period = $data["period"];
        $newvideogame->summary = $data["summary"];
        $newvideogame->link = $data["link"];

        if (array_key_exists("image", $data)) {
            $image_url = Storage::putFile("videogames", $data["image"]);
            $newvideogame->image = $image_url;
        }

        $newvideogame->save();

        if ($request->has("genres")) {
            $newvideogame->genres()->attach($data["genres"]);
        }
        return redirect()->route("admin.videogames.show", $newvideogame);
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
        $console = Type::all();
        $genres = Technology::all();
        return view("videogames.edit", compact("videogame", "console", "genres"));
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
