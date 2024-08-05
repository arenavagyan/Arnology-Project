<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
     $request = $request->only('email', 'password');
     $user = User::where('email', $request['email'])->first();

        if (! $user || ! Hash::check($request['password'], $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }


        $token = $user->createToken('auth-token')->plainTextToken;
        $user->auth_token = $token;
        Auth::setUser($user);
        return response()->json($token);
    }
    public function logout(){

        Auth::logout();

    }
}
