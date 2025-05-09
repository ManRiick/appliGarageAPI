<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\AuthController;

Route::post('/users', [UserController::class, 'index']);
Route::post('/vehicules', [VehiculeController::class, 'index']);
Route::post('/factures', [FactureController::class, 'index']);
Route::post('/taches', [TacheController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/ping', function () {
    return response()->json(['message' => 'Pong!']);
});

