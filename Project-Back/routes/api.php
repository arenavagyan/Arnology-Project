<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserDataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FindUserController;
use Illuminate\Support\Facades\Session;


//////// GET Requests //

//Route::middleware('auth:sanctum')
//    ->get('/user', function () {
//        return  response()->json(['data'=> auth()->user()]);
//    });
Route::get('/users/{user_id}',[   FindUserController::class,'findUserById']);

Route::middleware(['auth:sanctum'])->get('/user',[   FindUserController::class,'user']);

Route::get('/users',[FindUserController::class,'all']);
//    ->middleware(\App\Http\Middleware\CheckUserRegistered::class);



Route::get('/users/{user_id}/token',[  FindUserController::class,'findToken']);

Route::get('test',function (){
   return \Illuminate\Support\Facades\Session::getSessionConfig();
});
/////// POST Requests //

Route::post('/register',[RegisterController::class,'register']);

Route::post('/login',[LoginController::class,'login']);


/////// PATCH Requests //

Route::patch('changeData/users/{user_id}',[UserDataController::class,'changeData']);

