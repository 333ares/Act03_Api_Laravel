<?php

use App\Http\Controllers\DuenoController;
use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;

/**
 * RUTAS ANIMAL
 */
Route::get('/animales', [AnimalController::class, 'listarAnimales']);
Route::get('/animal/{id}', [AnimalController::class, 'verInfoAnimal']);
Route::post('/animal', [AnimalController::class, 'crearAnimal']);
Route::put('/animal/{id}', [AnimalController::class, 'modificarAnimal']);
Route::delete('/animal/{id}', [AnimalController::class, 'eliminarAnimal']);

/**
 * RUTAS DUEÑO
 */
Route::get('/duenos', [DuenoController::class, 'listarDuenos']);
Route::get('/dueno/{id}', [DuenoController::class, 'verInfoDueno']);
Route::post('/dueno', [DuenoController::class, 'crearDueno']);
Route::put('/dueno/{id}', [DuenoController::class, 'modificarDueno']);
Route::delete('/dueno/{id}', [DuenoController::class, 'eliminarDueno']);