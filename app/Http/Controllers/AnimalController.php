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
    function modificarAnimal(Request $request)
    {
        // Comprobamos datos obligatorios
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'tipo' => 'required|in:perro,gato,hamster,conejo'
        ]);

        if ($validator->fails()) {
            //Si la validación falla
            return response(
                [
                    'message' => 'error',
                    'animal' => 'El nombre y tipo del animal son datos obligatorios'
                ],
                400
            );
        } else {
            // Si en la validación esta todo correcto
            $animal = Animales::find($request->id); // Buscamos id de animal
            if ($animal) {
                // Si el animal existe modificamos los datos
                $animal->nombre = $request->nombre;
                $animal->tipo = $request->tipo;
                $animal->peso = $request->peso;
                $animal->enfermedad = $request->enfermedad;
                $animal->comentarios = $request->comentarios;
                $animal->save();

                return response(
                    [
                        'message' => 'success',
                        'animal' => $animal
                    ],
                    200
                );
            } else {
                // Si no existe mostramos error
                return response(
                    [
                        'message' => 'error',
                        'animal' => 'No existe ningun animal con ese ID'
                    ],
                    400
                );
            }
        }
    }

    /**
     * ELIMINAR ANIMAL
     */
    function eliminarAnimal($id)
    {
        $animal = Animales::find($id);

        if (!$animal) {
            return response([
                'message' => 'error',
                'animal' => 'No existe un animal con ese ID'
            ], 404);
        }

        $animal->delete();

        return response([
            'message' => 'success',
            'animal' => 'El animal se ha borrado correctamente'
        ], 200);
    }
}
