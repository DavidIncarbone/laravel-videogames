<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreScreenshotRequest;
use App\Http\Requests\Update\UpdateScreenshotRequest;
use App\Models\Screenshot;
use App\Models\Videogame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ScreenshotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Screenshot::query();
        if ($request->filled('search')) {
            $query->whereHas('videogame', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->orderFor == 'create' && $request->orderBy == 'desc') {
            $query->orderBy('created_at', 'desc');
        } elseif ($request->orderFor == 'edit' && $request->orderBy == 'asc') {
            $query->orderBy('updated_at');
        } elseif ($request->orderFor == 'edit' && $request->orderBy == 'desc') {
            $query->orderBy('updated_at', 'desc');
        }
        $screenshots = $query->paginate(5)->withQueryString();

        return view('screenshots/index', compact('screenshots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $videogames = Videogame::all();
        $videogameSlug = $request->query('screenshots');
        $videogame = Videogame::where('slug', $videogameSlug)->first();
        $screenshots = $videogame->screenshots ?? '';
        if ($screenshots) {
            $screenshotsCount = $videogame->screenshots->count();
            $remainingCount = 4 - $screenshotsCount;

            return view('screenshots/create', compact('videogames', 'videogame', 'screenshots', 'screenshotsCount', 'remainingCount'));
        }

        return view('screenshots/no-content-to-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScreenshotRequest $request)
    {



        $videogameId = $request->query('videogame_id');

        $data = $request->validated();

        if (array_key_exists('screenshots', $data)) {

            $screenshots = $data['screenshots'];
            foreach ($screenshots as $screenshot) {
                $newScreenshots = new Screenshot;
                $newScreenshots->videogame_id = $videogameId;
                $screenshots_url = Storage::putFile('img/videogames/screenshots', $screenshot);
                $newScreenshots->url = $screenshots_url;
                $newScreenshots->save();
            }

            if (count($screenshots) > 1) {
                toastr()->success('Screenshot aggiunti con successo!');
            } else {
                toastr()->success('Screenshot aggiunto con successo!');
            }
        } else {
            toastr()->info('Nessuno screenshot aggiunto');
        }

        return redirect()->route('admin.screenshots.index');
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
    public function edit(Screenshot $screenshot)
    {
        return view('screenshots.edit', compact('screenshot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScreenshotRequest $request, Screenshot $screenshot)
    {

        $data = $request->validated();
        // dd($data);

        if (array_key_exists('screenshot', $data)) {

            Storage::delete($screenshot->url);
            $image_url = Storage::putFile('img/videogames/screenshots', $data['screenshot']);
            $screenshot->url = $image_url;
        }

        $unchangedScreenshot = $screenshot->isClean();
        if ($unchangedScreenshot) {
            toastr()->info('Nessuna modifica effettuata');
        } else {
            toastr()->success("Lo screenshot di <span class='fw-bold'>" . Str::limit($screenshot->videogame->name, 20) . '</span> è stato modificato con successo');
        }

        $screenshot->update();

        return redirect()->route('admin.screenshots.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Screenshot $screenshot)
    {
        $name = $screenshot->videogame->name;
        $screenshot->delete();
        toastr()->success("Lo screenshot di <span class='fw-bold'>" . Str::limit($name, 20) . '</span> è stato eliminato con successo');

        return back();
    }

    public function destroyAll()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Screenshot::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        toastr()->success('Tutti gli screenshot sono stati eliminati con successo');

        return back();
    }

    public function destroySelected(Request $request)
    {

        $ids = $request->input('selected_screenshots', []);
        // dd($slugs);

        Screenshot::whereIn('id', $ids)->delete();

        if (count($ids) > 1) {
            toastr()->success('I <span class="fw-bold">' . count($ids) . ' screenshot</span> selezionati sono stati eliminati con successo');
        } else {
            toastr()->success('Lo screenshot selezionato è stata eliminato con successo');
        }

        return back();
    }
}
