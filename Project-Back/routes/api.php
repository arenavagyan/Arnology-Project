<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserDataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FindUserController;
use Illuminate\Support\Facades\Session;


//////// GET Requests //

Route::get('/users/{user_id}',[   FindUserController::class,'findUserById']);

Route::middleware(['auth:sanctum'])->get('/user',[FindUserController::class,'user']);

Route::get('/users',[FindUserController::class,'all']);



Route::get('test',function (){
   return \Illuminate\Support\Facades\Session::getSessionConfig();
});

/////// POST Requests //

Route::post('/register',[RegisterController::class,'register']);

Route::post('/login',[LoginController::class,'login']);


/////// PATCH Requests //

Route::patch('changeData/users/{user_id}',[UserDataController::class,'changeData']);

