<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserDataController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FindUserController;


//////// GET Requests //

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users/{user_id}',[   FindUserController::class,'findUserById']);
    Route::get('/user',[FindUserController::class,'user']);
    Route::get('/users',[FindUserController::class,'all']);
    Route::post('/userPassword',[FindUserController::class,'passwordCheck']);
});

Route::patch('changePassword/users/{user_id}',[UserDataController::class,'changePassword']);





Route::get('test',function (){
   return Auth::user();
})->name('test');

/////// POST Requests //

Route::post('/register',[RegisterController::class,'register']);

Route::post('/login',[LoginController::class,'login']);

Route::post('/logout',[LoginController::class,'logout']);

/////// PATCH Requests //

Route::patch('changeData/users/{user_id}',[UserDataController::class,'changeData']);

