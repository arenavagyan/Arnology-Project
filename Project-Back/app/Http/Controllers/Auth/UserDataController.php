<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeDataRequest;
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

    public function changeData(ChangeDataRequest $request){
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
    }


}
