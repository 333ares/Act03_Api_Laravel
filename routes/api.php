<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;

/**
 * RUTAS ANIMAL
 */
Route::get('/animales', [AnimalController::class, 'listarAnimales']);
Route::get('/animal', [AnimalController::class, 'verInfoAnimal']);
Route::post('/crearAnimal', [AnimalController::class, 'crearAnimal']);
Route::put('/modificarAnimal', [AnimalController::class, 'modificarAnimal']);