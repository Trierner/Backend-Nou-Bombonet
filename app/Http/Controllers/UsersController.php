<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // Método para mostrar todos los clientes
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        $user = User::paginate($limit, ['*'], 'page', $page);
        return response()->json($user, 200);
    }

    // Método para almacenar un nuevo cliente
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'phone' => 'string|nullable|max:8',
        ]);

        $passwordHasheada = Hash::make($request->input('password'));

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $passwordHasheada,
            'phone' => $request->input('phone'),
        ]);
        
        return response()->json($user, 201);
    }

    // Método para mostrar un cliente específico
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Método para actualizar un cliente
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string',
            'email' => 'email|unique:user,email,' . $id,
            'password' => 'string',
            'phone' => 'string|nullable|max:8',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->except('password'));

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }

        return response()->json($user, 200);
    }

    // Método para eliminar un cliente
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
