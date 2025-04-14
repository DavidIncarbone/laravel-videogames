<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pegi;

class PegiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegis = Pegi::all();
        return view("pegis.index", compact("pegis"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pegis.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();


        $newPegi = new Pegi;

        $newPegi->age = $data["age"];

        $newPegi->save();

        return redirect()->route("admin.pegis.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegi $pegi)
    {

        return view("pegis.edit", compact("pegi"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegi $pegi)
    {
        $data = $request->all();

        $pegi->age = $data["age"];

        $pegi->update();

        return redirect()->route("admin.pegis.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegi $pegi)
    {
        $pegi->delete();

        return redirect()->route("admin.pegis.index");
    }
}
