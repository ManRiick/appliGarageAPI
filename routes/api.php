<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\AuthController;

// 
Route::post('/users', [UserController::class, 'index']);

// log in et out
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// CRUD pour les véhicules
Route::get('/vehicules/garage', [VehiculeController::class, 'indexGarage']); // marche
Route::get('/vehicules/client/{id}', [VehiculeController::class, 'indexClient']); // marche
Route::post('/vehicules', [VehiculeController::class, 'store']);
Route::put('/vehicules/{id}', [VehiculeController::class, 'update']); // nice
Route::delete('/vehicules/{id}', [VehiculeController::class, 'destroy']);

// CRUD des tâches
Route::get('/vehicules/{vehicule_id}/details', [TacheController::class, 'getTachesByVehicule']);
// CRUD pour les tâches (accessible uniquement si l'utilisateur est garage dans le controller)
Route::post('/taches', [TacheController::class, 'store']);
Route::put('/taches/{id}', [TacheController::class, 'update']);
Route::delete('/taches/{id}', [TacheController::class, 'destroy']);





Route::post('/factures', [FactureController::class, 'index']);


Route::post('/ping', function () {
    return response()->json(['message' => 'Pong!']);
});

