<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeDataRequest;
use App\Http\Requests\NewPasswordRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Nette\Utils\Random;

class UserDataController extends Controller
{
    public function getData($id)
    {
        $user = User::find($id)->get();
        return $user;


    }

    public function changeData(ChangeDataRequest $request){

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

    }

    public function changePassword(NewPasswordRequest $request,$userId){

        $user = User::find($userId);
        $user->password = Hash::make($request->newPassword);
        $user->save();
        return $user->password;

    }



}
