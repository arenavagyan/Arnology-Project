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

    public function findUserByToken(Request $request){
       $token = $request->bearerToken();
       $accessToken = PersonalAccessToken::findToken($token);
       $user = User::find($accessToken->tokenable_id);
       return response()->json($user);
    }
    public function all(){
        $users = User::all();
        return response()->json($users);
    }


}
