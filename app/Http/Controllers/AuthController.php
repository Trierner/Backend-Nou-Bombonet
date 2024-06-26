<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;
            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'token' => $token,
                'usertype' => $user->usertype
            ]);
        } else {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:9',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'usertype' => 'user',
            'password' => Hash::make($request->password),
            'phone'=> $request->phone,
        ]);

        $token = $user->createToken('AuthToken')->plainTextToken;

        return response()->json([
            'token' => $token,
            'usertype' => $user->usertype
        ], 201);
    }
}
