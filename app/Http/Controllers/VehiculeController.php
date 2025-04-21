<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vehicules;

class VehiculeController extends Controller
{
    //
    public function index(Request $request)
    {
        // Get all vehicules
    
        $vehicules = Vehicules::all();
        return response()->json($vehicules);

        
    }
}
