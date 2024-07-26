<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\PersonalAccessToken;

class FindUserController extends Controller
{

    public function findUserById($userId){
      $user = User::find($userId);
      return response()->json($user);
    }

    public function findUserByToken($token){
       $accessToken = PersonalAccessToken::findToken($token);
       $user = User::find($accessToken->tokenable_id);
       return response()->json($user);
    }

    public function findToken($id){
       return User::find($id)->accessToken;

    }

    public function all(){
        $users = User::all();
        return response()->json($users);
    }


}
