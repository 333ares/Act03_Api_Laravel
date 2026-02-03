<?php

namespace App\Http\Controllers;

use App\Models\Duenos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DuenoController extends Controller
{
    /**
     * LISTAR DUEÑOS
     */
    function listarDuenos()
    {
        $duenos = Duenos::all();

        if (count($duenos) >= 1) {
            // Si hay duenos en la bd
            return response()->json(
                [
                    'message' => 'success',
                    'duenos' => $duenos
                ],
                200
            );
        } else {
            // si la bd esta vacía
            return response()->json(
                [
                    'message' => 'error',
                    'duenos' => 'No hay dueños registrados'
                ],
                400
            );
        }
    }

    /**
     * VER INFORMACIÓN DE UN DUEÑO
     */
    function verInfoDueno($id)
    {
        // Buscamos id del dueno
        $dueno = Duenos::find($id);

        // Si no se encuentra mostramos error
        if (!$dueno) {
            return response(
                [
                    'message' => 'error',
                    'dueno' => 'No existe un dueño con ese ID'
                ],
                400
            );
        }

        // Si se encuentra mostramos la info del dueno
        return response(
            [
                'message' => 'success',
                'dueno' => $dueno
            ],
            200
        );
    }

    /**
     * CREAR UN DUEÑO
     */
    function crearDueno(Request $request)
    {
        /* 
        Cogemos los datos que nos ha pasado el usuario
        y realizamos una serie de validaciones
        */
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'id_animal' => 'required|numeric',
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

        // Creamos un dueno solo con los datos que nos haya dado el usuario
        $dueno = Duenos::create($request->only([
            'nombre',
            'apellido',
            'id_animal',
        ]));

        // Cuando se haya creado, lo mostramos
        return response(
            [
                'message' => 'success',
                'dueno' => $dueno
            ],
            201
        );
    }

    /**
     * MODIFICAR DUEÑO
     */
    function modificarDueno(Request $request, $id)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'id_animal' => 'required|numeric',
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

        // Buscamos al dueño con el id que nos ha pasado el usuario
        $dueno = Duenos::find($id);

        // Si no se ha encontrado ningun dueño con ese id
        if (!$dueno) {
            return response(
                [
                    'message' => 'error',
                    'dueno' => 'No existe ningún dueño con ese ID'
                ],
                404
            );
        }

        // Actualizamos solo los campos necesarios
        $dueno->update($request->only([
            'nombre',
            'apellido',
            'id_animal',
        ]));

        // Mostramos dueño modificado
        return response(
            [
                'message' => 'success',
                'dueno' => $dueno
            ],
            200
        );
    }

    /**
     * ELIMINAR DUEÑO
     */
    function eliminarDueño($id)
    {
        // Buscamos al dueño con ese id
        $dueno = Duenos::find($id);

        // Si no existe, error
        if (!$dueno) {
            return response(
                [
                    'message' => 'error',
                    'dueno' => 'No existe un dueño con ese ID'
                ],
                404
            );
        }

        // Si existe lo borramos
        $dueno->delete();

        // Mostramos mensaje de éxito
        return response(
            [
                'message' => 'success',
                'dueno' => 'El dueño se ha borrado correctamente'
            ],
            200
        );
    }
}
