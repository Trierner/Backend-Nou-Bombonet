<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('correo', 'contraseña');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;
            return response()->json(['token' => $token]);
        } else {
            throw ValidationException::withMessages([
                'correo' => ['The provided credentials are incorrect.'],
            ]);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' =>'required|string|max:255',
            'correo' => 'required|string|correo|max:255|unique:users',
            'contraseña' => 'required|string|min:8|confirmed',
            'telefono' => 'string|nullable|max:8',
        ]);

        $user = Users::create([
            'nombre' => $request->nombre,
            'apellido'=> $request->apellido,
            'correo' => $request->correo,
            'contraseña' => Hash::make($request->contraseña),
            'telefono'=> $request->telefono,
        ]);

        $token = $user->createToken('AuthToken')->plainTextToken;

        return response()->json(['token' => $token], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'User logged out successfully']);
    }
}
