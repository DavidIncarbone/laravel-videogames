<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Console;
use Illuminate\Http\JsonResponse;

class ConsoleController extends Controller
{
    public function index(): JsonResponse
    {

        try {

            $consoles = Console::all();
            $consolesCount = Console::count();

            if ($consoles->isEmpty()) {

                return response()->json([
                    'success' => true,
                    'message' => 'Richiesta effettuata con successo',
                    'details' => 'Non ci sono Console nel database',
                ], 200);
            }

            return response()->json([
                'success' => true,
                'message' => 'Richiesta effettuata con successo',
                'count' => $consolesCount,
                'items' => $consoles,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Errore interno del server.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}
