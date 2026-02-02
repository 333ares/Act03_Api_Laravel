<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;

Route::post('/crearAnimal', [AnimalController::class, 'crearAnimal']);