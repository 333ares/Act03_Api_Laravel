<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;

/**
 * RUTAS ANIMAL
 */
Route::get('/animales', [AnimalController::class, 'listarAnimales']);
Route::get('/animal/{id}', [AnimalController::class, 'verInfoAnimal']);
Route::post('/animal', [AnimalController::class, 'crearAnimal']);
Route::put('/animal', [AnimalController::class, 'modificarAnimal']);
Route::delete('/animal/{id}', [AnimalController::class, 'eliminarAnimal']);