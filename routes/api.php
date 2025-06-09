<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\AuthController;

// log in et out
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// ping pour tester
Route::post('/ping', function () {
    return response()->json(['message' => 'Pong!']);
});

// pour les utilisateurs
Route::get('/getallusers', [UserController::class, 'getAllUsers']);
Route::get('/getalluserswithvehicule', [UserController::class, 'getAllUsersWithVehicule']);
Route::post('/uservehicule/{id}', [UserController::class, 'updateWithVehicules']);
Route::delete('/userdelete/{id}', [UserController::class, 'destroy']);

// CRUD véhicules et récupération selon rôle
Route::get('/vehicules', [VehiculeController::class, 'getAllVehicules']);
Route::get('/vehicules/client/{id}', [VehiculeController::class, 'indexClient']);
Route::get('/vehicule/user', [VehiculeController::class, 'getVehiculesWithUser']);
Route::get('/vehicules/{vehicule_id}/details', [TacheController::class, 'getTachesByVehicule']);
Route::delete('/vehicules/{id}', [VehiculeController::class, 'destroy']);
Route::post('/vehicules/all/{vehicule_id}', [TacheController::class, 'postTachesAndUserByVehicule']);

// Tâches
Route::get('/tacheinfo', [TacheController::class, 'indexInfo']);
Route::get('/tacheinfo/{id}', [TacheController::class, 'getTacheWithVehiculeAndUser']);
Route::post('/tacheupdate/{id}', [TacheController::class, 'postUpdateTacheById']);
Route::delete('/taches/{id}', [TacheController::class, 'destroy']);
