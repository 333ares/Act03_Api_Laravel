<?php

namespace App\Http\Controllers;

use App\Models\Animales;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperar todos los animales
        $animales = Animales::all();

        if (count($animales) >= 1) {
            // Si hay animales en la BD
            return response()->json(
                [
                    'message' => 'success',
                    'animales' => $animales
                ],
                200
            );
        } else {
            // si la Bd esta vacía
            return response()->json(
                [
                    'message' => 'error',
                    'animales' => 'No hay animales registrados'
                ],
                400
            );
        }
    }

    function crearAnimal(Request $request)
    {
        // Comprobamos que los campos obligatorios estan completos
        $request->validate([
            'nombre' => 'required',
            'tipo' => 'required'
        ]);

        // Creamos el animal
        $animal = Animales::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'peso' => $request->peso,
            'enfermedad' => $request->enfermedad,
            'comentarios' => $request->comentarios,
        ]);

        // Comprobamso que se haya insertado bien
        $animal = Animales::find($animal->id);

        if ($animal) {
            // Si se ha insertado bien
            return response(
                [
                    'message' => 'success',
                    'animal' => $animal,
                    'status' => 200
                ]
            );
        } else {
            // Si ha habido un error
            return response(
                [
                    'message' => 'error',
                    'animal' => 'El animal no existe',
                    'status' => 404
                ]
            );
        }
    }
}
