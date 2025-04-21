<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Factures;
use Illuminate\Http\Request;
use App\Models\Taches;
use App\Models\Vehicules;
use App\Models\User;

class FactureController extends Controller
{
    //
    public function index(Request $request)
    {
        // Get all invoices
        $invoices = Factures::all();

        // Return the invoices as a JSON response
        return response()->json($invoices);
    }
}
