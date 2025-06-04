<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicules;

class VehiculeController extends Controller
{
    // Tous les véhicules (pour garage)
    public function indexGarage()
    {
        return response()->json(Vehicules::all());
    }

    // Véhicules pour un client spécifique
    public function indexClient($id)
    {
        return response()->json(
            Vehicules::where('user_id', $id)->get()
        );
    }

    // Ajouter un véhicule
    public function store(Request $request)
    {
        $validated = $request->validate([
            'marque' => 'required|string',
            'modele' => 'required|string',
            'immatriculation' => 'required|string|unique:vehicules',
            'annee' => 'required|integer',
            'kilometrage' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $vehicule = Vehicules::create($validated);

        return response()->json($vehicule, 201);
    }

    // Modifier un véhicule
    public function update(Request $request, $id)
    {
        $vehicule = Vehicules::findOrFail($id);

        $vehicule->update($request->only([
            'marque', 'modele', 'immatriculation', 'annee', 'kilometrage'
        ]));

        return response()->json($vehicule);
    }

    // Supprimer un véhicule
    public function destroy($id)
    {
        $vehicule = Vehicules::findOrFail($id);
        $vehicule->delete();

        return response()->json(['message' => 'Véhicule supprimé']);
    }
}
