<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vehicules;
use App\Models\User;
use App\Models\Factures;
use App\Models\Taches;

class TacheController extends Controller
{
    //
    public function index(Request $request)
    {
        // Get all tasks
        $tasks = Taches::all();

        // Return the tasks as a JSON response
        return response()->json($tasks);
    }
}
