<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserDataController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//////// GET Requests //

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users/{user_id}',[UserController::class,'findUserById']);
    Route::get('/user',[UserController::class,'user']);
    Route::get('/users',[UserController::class,'all']);
    Route::post('/userPassword',[UserController::class,'passwordCheck']);
    Route::patch('changePassword/users/{user_id}',[UserDataController::class,'changePassword']);
});


Route::middleware(['auth:sanctum','isAdmin'])->group(function () {
    Route::post('/addUser',[UserController::class,'addUser']);
    Route::delete('/delete/users/{userId}',[UserController::class,'deleteUser']);
});



Route::get('test',function (){
   return Auth::user();
})->name('test');



/////// POST Requests //

Route::post('/register',[RegisterController::class,'register']);

Route::post('/login',[LoginController::class,'login']);

Route::post('/logout',[LoginController::class,'logout']);

/////// PATCH Requests //

Route::patch('changeData/users/{user_id}',[UserDataController::class,'changeData']);

