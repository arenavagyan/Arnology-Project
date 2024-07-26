<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Nette\Utils\Random;
use App\Http\Controllers\Auth\UserDataController;

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

        return response()->json($token);
    }

}
