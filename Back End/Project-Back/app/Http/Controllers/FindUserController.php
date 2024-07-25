<?php

namespace App\Http\Controllers;

use App\Models\User;

class FindUserController extends Controller
{

    public function findUserById($userId){
      $user = User::find($userId);
      return response()->json($user);
    }

    public function all(){
        $users = User::all();
        return response()->json($users);
    }


}
