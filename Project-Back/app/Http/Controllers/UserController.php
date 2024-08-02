<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function all(){
        $users = User::all()->except(Auth::id());
        return response()->json($users);
    }

    public function user(){
        $user = Auth::user();
        return response()->json(['user'=> $user]);
    }

    public function findUserById($userId){
        $user = User::find($userId);
        return response()->json($user);
    }

    public function passwordCheck(PasswordRequest $request){


        $password = Auth::user()->getAuthPassword();
        $isSame = Hash::check($request->password, $password);
        if ($isSame) return response()->json($isSame);
        else return response()->json(false);

    }

    public function addUser(Request $request){

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = \Illuminate\Support\Str::random(10);
        $user->save();
    }

    public function deleteUser(Request $request){

        if ($request->userId !== Auth::id()){

        $user = User::find($request->userId);
        $user->delete();

        }

    }
}
