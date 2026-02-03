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
    function listarAnimales()
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
        // Buscamos id del animal
        $animal = Animales::find($id);

        // Si no se encuentra mostramos error
        if (!$animal) {
            return response(
                [
                    'message' => 'error',
                    'animal' => 'No existe un animal con ese ID'
                ],
                400
            );
        }

        // Si se encuentra mostramos la info del animal
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
        /* 
        Cogemos los datos que nos ha pasado el usuario
        y realizamos una serie de validaciones
        */
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'tipo' => 'required|in:perro,gato,hamster,conejo',
            'peso' => 'nullable|numeric',
            'enfermedad' => 'nullable|string',
            'comentarios' => 'nullable|string',
        ]);

        // Si el validadador falla mostramos error
        if ($validator->fails()) {
            return response(
                [
                    'message' => 'error',
                    'errors' => $validator->errors()
                ],
                400
            );
        }

        // Creamos un animal solo con los datos que nos haya dado el usuario
        $animal = Animales::create($request->only([
            'nombre',
            'tipo',
            'peso',
            'enfermedad',
            'comentarios'
        ]));

        // Cuando se haya creado, lo mostramos
        return response(
            [
                'message' => 'success',
                'animal' => $animal
            ],
            201
        );
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

        // Si algun dato introducido es incorrecto
        if ($validator->fails()) {
            return response(
                [
                    'message' => 'error',
                    'errors' => $validator->errors()
                ],
                400
            );
        }

        // Buscamos al animal con el id que nos ha pasado el usuario
        $animal = Animales::find($id);

        // Si no se ha encontrado ningun animal con ese id
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

        // Mostramos animal modificado
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
        // Buscamos al animal con ese id
        $animal = Animales::find($id);

        // Si no existe, error
        if (!$animal) {
            return response(
                [
                    'message' => 'error',
                    'animal' => 'No existe un animal con ese ID'
                ],
                404
            );
        }

        // Si existe lo borramos
        $animal->delete();

        // Mostramos mensaje de éxito
        return response(
            [
                'message' => 'success',
                'animal' => 'El animal se ha borrado correctamente'
            ],
            200
        );
    }
}
