<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;

Route::get('/animales', [AnimalController::class, 'index']);
Route::post('/crearAnimal', [AnimalController::class, 'crearAnimal']);