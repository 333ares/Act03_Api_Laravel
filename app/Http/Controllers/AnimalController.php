<?php

namespace App\Http\Controllers;

use App\Models\Animales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnimalController extends Controller
{
    /**
     * LISTAR ANIMALES
     */
    public function listarAnimales()
    {
        // Recuperar todos los animales
        $animales = Animales::all();

        if (count($animales) >= 1) {
            // Si hay animales en la bd
            return response()->json(
                [
                    'message' => 'success',
                    'animales' => $animales
                ],
                200
            );
        } else {
            // si la bd esta vacía
            return response()->json(
                [
                    'message' => 'error',
                    'animales' => 'No hay animales registrados'
                ],
                400
            );
        }
    }

    /**
     * VER INFORMACIÓN DE UN ANIMAL
     */
    function verInfoAnimal(Request $request)
    {
        // Comprobamos que el id haya sido proporcionado
        $validator = Validator::make($request->all(), ['id' => 'required']);

        if ($validator->fails()) {
            // Si no se ha encontrado animal con ese ID
            return response(
                [
                    'message' => 'error',
                    'animal' => 'El ID no existe o es incorrecto'
                ],
                400
            );
        } else {
            // Si se ha encontrado lo mostramos
            $animal = Animales::find($request->id);
            return response(
                [
                    'message' => 'success',
                    'animal' => $animal
                ],
                200
            );
        }
    }

    /**
     * CREAR UN ANIMAL
     */
    function crearAnimal(Request $request)
    {
        // Comprobamos que los campos cumplen con las reglas
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'tipo' => 'required|in:perro,gato,hamster,conejo' // Solo permitimos esos animales
        ]);

        if ($validator->fails()) {
            // Si las validaciones fallan mostramos error
            return response(
                [
                    'message' => 'error',
                    'animal' => 'El nombre y tipo del animal son datos obligatorios'
                ],
                400
            );
        } else {
            // Si las validaciones son correctas creamos el animal en la bd
            $animal = Animales::create([
                'nombre' => $request->nombre,
                'tipo' => $request->tipo,
                'peso' => $request->peso,
                'enfermedad' => $request->enfermedad,
                'comentarios' => $request->comentarios,
            ]);

            // Mostramos el animal creado
            $animal = Animales::find($animal->id);
            return response(
                [
                    'message' => 'success',
                    'animal' => $animal
                ],
                200
            );
        }
    }
}
