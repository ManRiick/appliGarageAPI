<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\TacheController;

Route::post('/users', [UserController::class, 'index']);
Route::post('/vehicules', [VehiculeController::class, 'index']);
Route::post('/factures', [FactureController::class, 'index']);
Route::post('/taches', [TacheController::class, 'index']);
