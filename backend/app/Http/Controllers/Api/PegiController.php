<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegi;

class PegiController extends Controller
{
    public function index()
    {

        $pegis = Pegi::all();
        $pegisCount = Pegi::count();

        return response()->json([
            "success" => true,
            "count" => $pegisCount,
            "data" => $pegis
        ]);
    }
}
