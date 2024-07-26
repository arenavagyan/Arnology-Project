<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\PersonalAccessToken;
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

    public function findToken($id){
       return User::find($id)->auth_token;
    }

    public function all(){
        $users = User::all();
        return response()->json($users);
    }


}
