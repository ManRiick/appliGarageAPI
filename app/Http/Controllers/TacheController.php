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
    // ✅ Créer une tâche
public function store(Request $request)
{
    $user = auth()->user();
    if (!$user->is_garage) {
        return response()->json(['message' => 'Accès refusé'], 403);
    }

    $validated = $request->validate([
        'description' => 'required|string',
        'prix' => 'required|numeric',
        'duree_jour' => 'required|integer',
        'vehicule_id' => 'required|exists:vehicules,id',
        'statut' => 'required|string',
    ]);

    $tache = Taches::create($validated);
    return response()->json($tache, 201);
}

// ✏️ Modifier une tâche
public function update(Request $request, $id)
{
    $user = auth()->user();
    if (!$user->is_garage) {
        return response()->json(['message' => 'Accès refusé'], 403);
    }

    $tache = Taches::findOrFail($id);

    $tache->update($request->only([
        'description', 'prix', 'duree_jour', 'statut'
    ]));

    return response()->json($tache);
}

// ❌ Supprimer une tâche
public function destroy($id)
{
    $user = auth()->user();
    if (!$user->is_garage) {
        return response()->json(['message' => 'Accès refusé'], 403);
    }

    $tache = Taches::findOrFail($id);
    $tache->delete();

    return response()->json(['message' => 'Tâche supprimée avec succès']);
}

public function getTachesByVehicule(Request $request, $vehicule_id)
{
    $vehicule = Vehicules::find($vehicule_id);

    if (!$vehicule) {
        return response()->json(['message' => 'Accès refusé'], 403);
    }

    $tasks = Taches::where('vehicule_id', $vehicule_id)->get();

    return response()->json([
        'vehicule' => $vehicule,
        'taches' => $tasks
    ]);
}




}