<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // Método para mostrar todos los clientes
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        $users = Users::paginate($limit, ['*'], 'page', $page);
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
            'admin' => 'boolean',
        ]);

        $contraseñaHasheada = Hash::make($request->input('contraseña'));

        $user = Users::create([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'correo' => $request->input('correo'),
            'contraseña' => $contraseñaHasheada,
            'telefono' => $request->input('telefono'),
            'admin' => $request->input('admin'),
        ]);
        
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
            'admin' => 'boolean',
        ]);

        $user = Users::findOrFail($id);
        $user->update($request->except('contraseña'));

        if ($request->filled('contraseña')) {
            $user->contraseña = Hash::make($request->input('contraseña'));
            $user->save();
        }

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
