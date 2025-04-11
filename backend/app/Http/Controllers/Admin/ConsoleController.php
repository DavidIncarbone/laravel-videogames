<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\console;

class consoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $console = console::all();
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
    public function store(Request $request, console $console)
    {
        $data = $request->all();
        $newconsole = new console;
        $newconsole->name = $data["name"];
        $newconsole->description = $data["description"];
        $newconsole->save();
        return redirect()->route("admin.console.show", $newconsole);
    }

    /**
     * Display the specified resource.
     */
    public function show(console $console)
    {
        return view("console.show", compact("console"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(console $console)
    {
        $console = console::all();

        return view("console.edit", compact("console", "console"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, console $console)
    {
        $data = $request->all();

        $console->name = $data["name"];
        $console->description = $data["description"];

        $console->update();

        return redirect()->route("admin.console.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(console $console)
    {
        $console->delete();

        return redirect()->route("admin.console.index");
    }
}
