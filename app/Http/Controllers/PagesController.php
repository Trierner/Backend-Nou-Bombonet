<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function menu()
    {
        $user = Auth::user();

        if ($user->usertype !== 'user') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json(['message' => 'Welcome to the Menu'], 200);
    }

    public function order()
    {
        $user = Auth::user();

        if ($user->usertype !== 'user') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json(['message' => 'Welcome to the Order'], 200);
    }

    public function booking()
    {
        $user = Auth::user();

        if ($user->usertype !== 'user') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json(['message' => 'Welcome to the Booking'], 200);
    }

    public function aboutus()
    {
        $user = Auth::user();

        if ($user->usertype !== 'user') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json(['message' => 'Welcome to the About Us'], 200);
    }

    public function contact()
    {
        $user = Auth::user();

        if ($user->usertype !== 'user') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json(['message' => 'Welcome to the Contact'], 200);
    }
}
