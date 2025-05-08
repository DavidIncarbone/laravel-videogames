<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Console;

class ConsoleController extends Controller
{
    public function index()
    {

        $consoles = Console::all();
        $consolesCount = Console::count();

        return response()->json([
            "success" => true,
            "count" => $consolesCount,
            "data" => $consoles
        ]);
    }
}
