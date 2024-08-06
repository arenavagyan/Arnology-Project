<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserDataController;
use App\Http\Controllers\CalendarController;
use \App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users/{user_id}',[UserController::class,'findUserById']);
    Route::get('/user',[UserController::class,'user']);
    Route::get('/users',[UserController::class,'all']);
    Route::get('/setImage/images/{imagePath}',[ImageController::class,'setUserImage']);
    Route::get('/images/{imageName}',[ImageController::class,'getUserImage']);
    Route::get('/currentUserImageName',[ImageController::class,'getUserAvatar']);
    Route::get('/sendVerificationCode',[VerificationController::class,'sendVerificationCode']);
    Route::post('/uploadImage',[ImageController::class,'upload']);
    Route::post('/userPassword',[UserController::class,'passwordCheck']);
    Route::patch('changeData/users/{user_id}',[UserDataController::class,'changeData']);
    Route::patch('changePassword/users/{user_id}',[UserDataController::class,'changePassword']);
});


Route::middleware(['auth:sanctum','isAdmin'])->group(function () {
    Route::post('/addUser',[UserController::class,'addUser']);
    Route::delete('/delete/users/{userId}',[UserController::class,'deleteUser']);
});


Route::get('test',function (){ return Auth::user();})->name('test');
Route::get('/images/{imageName}',[ImageController::class,'imageFileGetter']);
Route::post('/register',[RegisterController::class,'register']);
Route::post('/login',[LoginController::class,'login']);
Route::post('/logout',[LoginController::class,'logout']);



Route::get('/parse-ics', [CalendarController::class, 'parseIcs']);
