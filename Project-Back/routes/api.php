<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserDataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FindUserController;

Route::post('/register',[RegisterController::class,'register']);

Route::post('/login',[LoginController::class,'login']);

Route::get('/users/{user_id}',[   FindUserController::class,'findUserById']);

Route::get('/user/{token}',[   FindUserController::class,'findUserByToken']);;

Route::get('/users',[FindUserController::class,'all']);

