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
    // creation de tache
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

// modif de tache
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

// suppression de tache
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

// recuperation des taches par vehicule
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

// API POST pour lecture + modification des tâches et utilisateur liés à un véhicule
public function postTachesAndUserByVehicule(Request $request, $vehicule_id)
{
    $vehicule = Vehicules::find($vehicule_id);

    if (!$vehicule) {
        return response()->json(['message' => 'Véhicule non trouvé'], 404);
    }

    // Mise à jour du véhicule si des données sont envoyées
    if ($request->has('vehicule')) {
        $vehicule->update($request->input('vehicule'));
    }

    // Récupération et mise à jour de l'utilisateur si nécessaire
    $user = User::find($vehicule->user_id);
    if (!$user) {
        return response()->json(['message' => 'Utilisateur non trouvé'], 404);
    }
    if ($request->has('user')) {
        $user->update($request->input('user'));
    }

    // Mise à jour ou ajout des tâches
    if ($request->has('taches') && is_array($request->input('taches'))) {
        foreach ($request->input('taches') as $tacheData) {
            if (isset($tacheData['id'])) {
                // Mise à jour d'une tâche existante
                $tache = Taches::find($tacheData['id']);
                if ($tache && $tache->vehicule_id == $vehicule_id) {
                    $tache->update($tacheData);
                }
            } else {
                // Création d'une nouvelle tâche
                $tacheData['vehicule_id'] = $vehicule_id;
                Taches::create($tacheData);
            }
        }
    }

    // Récupérer les données mises à jour
    $taches = Taches::where('vehicule_id', $vehicule_id)->get();

    return response()->json([
        'vehicule' => $vehicule,
        'user' => $user,
        'taches' => $taches
    ]);
}

}