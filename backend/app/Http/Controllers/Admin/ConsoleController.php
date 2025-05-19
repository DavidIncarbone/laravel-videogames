<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreConsoleRequest;
use App\Http\Requests\Update\UpdateConsoleRequest;
use App\Models\Console;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConsoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Console::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->orderFor == 'create' && $request->orderBy == 'desc') {
            $query->orderBy('created_at', 'desc');
        } elseif ($request->orderFor == 'edit' && $request->orderBy == 'asc') {
            $query->orderBy('updated_at');
        } elseif ($request->orderFor == 'edit' && $request->orderBy == 'desc') {
            $query->orderBy('updated_at', 'desc');
        }
        $consoles = $query->paginate(5)->withQueryString();

        return view('consoles/index', compact('consoles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('consoles/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConsoleRequest $request, Console $console)
    {

        // VALIDATION

        $data = $request->validated();
        $newConsole = new Console;
        $newConsole->name = Str::of($data['name'])->trim();

        if (array_key_exists('logo', $data)) {

            $logo_url = Storage::putFile('img/consoles/logos', $data['logo']);
            $newConsole->logo = $logo_url;
        }

        $newConsole->save();
        toastr()->success("<span class='fw-bold'>" . Str::limit($newConsole->name, 20) . '</span> è stata aggiunta con successo');

        return redirect()->route('admin.consoles.index', $newConsole);
    }

    /**
     * Display the specified resource.
     */
    public function show(Console $console)
    {
        return view('consoles.show', compact('console'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Console $console)
    {

        return view('consoles.edit', compact('console'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConsoleRequest $request, Console $console)
    {
        // VALIDATION

        $data = $request->validated();
        // dd($data);
        $console->name = $data['name'];

        if (array_key_exists('logo', $data)) {

            $logo_url = Storage::putFile('img/consoles/logos', $data['logo']);
            $console->logo = $logo_url;
        }

        $unchangedConsole = $console->isClean();
        if ($unchangedConsole) {
            toastr()->info('Nessuna modifica effettuata');
        } else {
            toastr()->success("<span class='fw-bold'>" . Str::limit($console->name, 20) . '</span> è stata modificata con successo');
        }

        $console->update();

        return redirect()->route('admin.consoles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Console $console)
    {
        $name = $console->name;
        $console->delete();
        toastr()->success("<span class='fw-bold'>" . Str::limit($name, 20) . '</span> è stata eliminata con successo');

        return back();
    }

    public function destroyAll()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Console::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        toastr()->success('Tutte le console sono state eliminate con successo');

        return back();
    }

    public function destroySelected(Request $request)
    {

        $ids = $request->input('selected_consoles', []);
        // dd($slugs);

        Console::whereIn('id', $ids)->delete();

        if (count($ids) > 1) {
            toastr()->success('Le <span class="fw-bold">' . count($ids) . ' Console</span> selezionate sono state eliminate con successo');
        } else {
            toastr()->success('La console selezionata è stata eliminata con successo');
        }

        return back();
    }
}
