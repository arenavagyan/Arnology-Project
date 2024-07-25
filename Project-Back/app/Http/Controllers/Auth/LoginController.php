<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Random;

class LoginController extends Controller
{
    public function login(Request $request)
    {



        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            Auth::getUser()->setRememberToken(Random::generate(10));
            return Auth::getUser();
        }
        else return 'Wrong Email or Password';
    }
}
