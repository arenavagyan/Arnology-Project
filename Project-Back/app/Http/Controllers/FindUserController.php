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

    public function passwordCheck(PasswordRequest $request){

        $password = Auth::user()->getAuthPassword();
        dd($request->getPassword());
        $isSame = Hash::check($request->password, $password);

        return response()->json($isSame);

    }

    public function all(){
        $users = User::all();
        return response()->json($users);
    }


}
