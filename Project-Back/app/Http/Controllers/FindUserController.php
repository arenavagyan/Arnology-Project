<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class FindUserController extends Controller
{

    public function findUserById($userId){
      $user = User::find($userId);
      return response()->json($user);
    }
    public function user(){
       $user = Auth::user();
       return response()->json(['user'=> $user]);
    }

    public function all(){
        $users = User::all();
        return response()->json($users);
    }
    public function passwordCheck(PasswordRequest $request){


        $password = Auth::user()->getAuthPassword();
        $isSame = Hash::check($request->password, $password);
        if ($isSame) return response()->json($isSame);
        return response()->json(false);

    }

    public function updatePassword(PasswordRequest $request){}
}
