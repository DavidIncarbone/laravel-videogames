<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $console = Type::all();
        return view("console/index", compact("console"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("console/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Type $type)
    {
        $data = $request->all();
        $newType = new Type;
        $newType->name = $data["name"];
        $newType->description = $data["description"];
        $newType->save();
        return redirect()->route("admin.console.show", $newType);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view("console.show", compact("type"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        $console = Type::all();

        return view("console.edit", compact("type", "console"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $data = $request->all();

        $type->name = $data["name"];
        $type->description = $data["description"];

        $type->update();

        return redirect()->route("admin.console.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route("admin.console.index");
    }
}
