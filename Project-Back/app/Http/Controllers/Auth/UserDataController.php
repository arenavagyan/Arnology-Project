<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Nette\Utils\Random;

class UserDataController extends Controller
{
    public function getData($id)
    {
        $user = User::find($id)->get();
        return $user;


    }


}