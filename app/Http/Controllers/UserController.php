<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicule;
use App\Models\Vehicules;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Handle the incoming request.
     */
   public function index(Request $request)
    {
        // Get all users
        $users = User::all();

        // Return the users as a JSON response
        return response()->json($users);
    }
    public function getAllUsers()
    {
        // Get all users
        $users = User::all();

        // Return the users as a JSON response
        return response()->json($users);
    }

    // get all users plus voiture si existe
    public function getAllUsersWithVehicule()
    {
        // Get all users with their vehicles
        $users = User::with('vehicule')->get();

        // Return the users as a JSON response
        return response()->json($users);
    }

public function updateWithVehicules(Request $request, $id)
{
    // 1. Trouver l'utilisateur
    $user = User::find($id);
    if (!$user) {
        return response()->json(['message' => 'Utilisateur introuvable'], 404);
    }

    // 2. Si données user présentes, mettre à jour
    if ($request->has('user')) {
        $request->validate([
            'user.name' => 'required|string|max:255',
            'user.email' => 'required|email|max:255',
        ]);

        $user->update([
            'name' => $request->input('user.name'),
            'email' => $request->input('user.email'),
        ]);
    }

    // 3. Si véhicules présents, les mettre à jour
    if ($request->has('vehicules')) {
        $request->validate([
            'vehicules' => 'array',
            'vehicules.*.id' => 'required|exists:vehicules,id',
            'vehicules.*.marque' => 'required|string|max:255',
            'vehicules.*.modele' => 'required|string|max:255',
            'vehicules.*.immatriculation' => 'required|string|max:255',
            'vehicules.*.annee' => 'required|integer',
            'vehicules.*.kilometrage' => 'nullable|string|max:255',
        ]);

        foreach ($request->input('vehicules') as $vehiculeData) {
            $vehicule = Vehicules::where('id', $vehiculeData['id'])
                                  ->where('user_id', $user->id)
                                  ->first();

            if ($vehicule) {
                $vehicule->update([
                    'marque' => $vehiculeData['marque'],
                    'modele' => $vehiculeData['modele'],
                    'immatriculation' => $vehiculeData['immatriculation'],
                    'annee' => $vehiculeData['annee'],
                    'kilometrage' => $vehiculeData['kilometrage'] ?? null,
                ]);
            }
        }
    }

    $user->load('vehicules');

    return response()->json([
        'message' => 'Utilisateur récupéré avec succès',
        'user' => $user
    ]);
}

// suppression d'utilisateur
public function destroy($id)
{
    // Trouver l'utilisateur
    $user = User::find($id);
    if (!$user) {
        return response()->json(['message' => 'Utilisateur introuvable'], 404);
    }

    // Supprimer l'utilisateur
    $user->delete();

    return response()->json(['message' => 'Utilisateur supprimé avec succès']);
}
}
