<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;

class RegisterController extends Controller
{
    public function register(RegisterUserRequest $request)
    {

         User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'remember_token' => Random::generate(10),
             'is_registered' => true
        ]);


        return 'Registration Successful!';

    }
}
