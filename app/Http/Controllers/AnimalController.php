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
    function verInfoAnimal($id)
    {
        $animal = Animales::find($id);

        if (!$animal) {
            return response(
                [
                    'message' => 'error',
                    'animal' => 'No existe un animal con ese ID'
                ],
                400
            );
        }

        return response(
            [
                'message' => 'success',
                'animal' => $animal
            ],
            200
        );
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

    /**
     * MODIFICAR ANIMAL
     */
    function modificarAnimal(Request $request, $id)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'tipo' => 'required|in:perro,gato,hamster,conejo',
            'peso' => 'nullable|numeric',
            'enfermedad' => 'nullable|string',
            'comentarios' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response(
                [
                    'message' => 'error',
                    'errors' => $validator->errors()
                ],
                400
            );
        }

        $animal = Animales::find($id);

        if (!$animal) {
            return response(
                [
                    'message' => 'error',
                    'animal' => 'No existe ningún animal con ese ID'
                ],
                404
            );
        }

        // Actualizamos solo los campos necesarios
        $animal->update($request->only([
            'nombre',
            'tipo',
            'peso',
            'enfermedad',
            'comentarios'
        ]));

        return response(
            [
                'message' => 'success',
                'animal' => $animal
            ],
            200
        );
    }


    /**
     * ELIMINAR ANIMAL
     */
    function eliminarAnimal($id)
    {
        $animal = Animales::find($id);

        if (!$animal) {
            return response(
                [
                    'message' => 'error',
                    'animal' => 'No existe un animal con ese ID'
                ],
                404
            );
        }

        $animal->delete();

        return response(
            [
                'message' => 'success',
                'animal' => 'El animal se ha borrado correctamente'
            ],
            200
        );
    }
}
