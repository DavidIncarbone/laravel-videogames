<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\genre;

class genreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = genre::all();

        return view("genres/index", compact("genres"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("genres.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newgenre = new genre;
        $newgenre->name = $data["name"];
        $newgenre->description = $data["description"];
        $newgenre->color = $data["color"];

        $newgenre->save();

        return redirect()->route("admin.genres.show", $newgenre);
    }

    /**
     * Display the specified resource.
     */
    public function show(genre $genre)
    {
        return view("genres.show", compact("genre"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(genre $genre)
    {
        return view("genres.edit", compact("genre"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, genre $genre)
    {
        $data = $request->all();

        $genre->name = $data["name"];
        $genre->description = $data["description"];
        $genre->color = $data["color"];

        $genre->update();

        return redirect()->route("admin.genres.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(genre $genre)
    {
        $genre->delete();

        return redirect()->route("admin.genres.index");
    }
}
