<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class UsersController extends Controller
{
    // Método para mostrar todos los clientes
    public function index()
    {
        $users = Users::all();
        return response()->json($users);
    }

    // Método para almacenar un nuevo cliente
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'correo' => 'required|email|unique:clientes',
            'contraseña' => 'required|string',
            'telefono' => 'string|nullable|max:8',
            'direccion' => 'string|nullable',
            'admin' => 'boolean',
        ]);

        $user = Users::create($request->all());
        return response()->json($user, 201);
    }

    // Método para mostrar un cliente específico
    public function show($id)
    {
        $user = Users::findOrFail($id);
        return response()->json($user);
    }

    // Método para actualizar un cliente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'string',
            'apellido' => 'string',
            'correo' => 'email|unique:users,correo,' . $id,
            'contraseña' => 'string',
            'telefono' => 'string|nullable|max:8',
            'direccion' => 'string|nullable',
            'admin' => 'boolean',
        ]);

        $user = Users::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    // Método para eliminar un cliente
    public function destroy($id)
    {
        $user = Users::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
