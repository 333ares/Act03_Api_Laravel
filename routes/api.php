<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;

Route::get('/animales', [AnimalController::class, 'listarAnimales']);
Route::get('/animal', [AnimalController::class, 'verInfoAnimal']);
Route::post('/crearAnimal', [AnimalController::class, 'crearAnimal']);
