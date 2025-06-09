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
    public function indexInfo()
{
    $taches = Taches::with(['vehicule.user'])
        ->orderByDesc('id')
        ->get();

    $result = $taches->map(function ($tache) {
        return [
            'tache' => $tache,
            'vehicule' => $tache->vehicule,
            'user' => $tache->vehicule?->user
        ];
    });

    return response()->json($result);
}


// suppression de tache
public function destroy($id)
{
    $tache = Taches::findOrFail($id);
    $tache->delete();
    return response()->json(['message' => 'Tâche supprimée']);

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
public function getTacheWithVehiculeAndUser($id)
{
    $tache = Taches::with(['vehicule.user'])->find($id);

    if (!$tache) {
        return response()->json(['error' => 'Tâche non trouvée'], 404);
    }

    // Renvoie juste la tâche avec véhicule et user inclus
    return response()->json($tache);
}

// API POST pour lecture + modification des vehicules et utilisateur liés à un tache

public function postUpdateTacheById(Request $request, $tache_id)
{
    $tache = Taches::find($tache_id);

    if (!$tache) {
        return response()->json(['message' => 'Tâche non trouvée'], 404);
    }

    // Mise à jour des champs de la tâche (depuis taches[0])
    if ($request->has('taches') && is_array($request->taches) && count($request->taches) > 0) {
        $tache->update($request->taches[0]);
    }

    // Mise à jour du véhicule et association
    if ($request->has('vehicule') && isset($request->vehicule['id'])) {
        $vehicule = Vehicules::find($request->vehicule['id']);
        if ($vehicule) {
            $tache->vehicule_id = $vehicule->id;
            $tache->save();

            if (!empty($request->vehicule)) {
                $vehicule->update($request->vehicule);
            }
        } else {
            return response()->json(['message' => 'Véhicule non trouvé'], 404);
        }
    }

    // Mise à jour du user associé au véhicule
    if ($request->has('user') && isset($request->user['id'])) {
        $user = User::find($request->user['id']);
        if ($user) {
            $vehicule = $tache->vehicule;
            if ($vehicule) {
                $vehicule->user_id = $user->id;
                $vehicule->save();
            }

            if (!empty($request->user)) {
                $user->update($request->user);
            }
        } else {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
    }

    return response()->json([
        'message' => 'Tâche mise à jour avec succès',
        'tache' => $tache->load('vehicule.user')
    ]);
}




}