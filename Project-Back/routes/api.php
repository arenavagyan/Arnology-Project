<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserDataController;
use App\Http\Middleware\IsAdmin;
use \App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
//////// GET Requests //

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users/{user_id}',[UserController::class,'findUserById']);
    Route::get('/user',[UserController::class,'user']);
    Route::get('/users',[UserController::class,'all']);
    Route::post('/userPassword',[UserController::class,'passwordCheck']);
    Route::patch('changePassword/users/{user_id}',[UserDataController::class,'changePassword']);
    Route::post('/uploadImage',[ImageController::class,'upload']);
    Route::get('/setImage/images/{imagePath}',[ImageController::class,'setUserImage']);
    Route::get('/images/{imageName}',[ImageController::class,'getUserImage']);
    Route::get('/currentUserImageName',[ImageController::class,'getUserAvatar']);
    Route::post('/sendVerificationCode',[VerificationController::class,'sendVerificationCode']);


});


Route::get('/images/{imageName}',[ImageController::class,'imageFileGetter']);






Route::middleware(['auth:sanctum','isAdmin'])->group(function () {
    Route::post('/addUser',[UserController::class,'addUser']);
    Route::delete('/delete/users/{userId}',[UserController::class,'deleteUser']);
});




//    function (){
//   $file = \Illuminate\Support\Facades\File::get(public_path('/images/1.jpg'));
//    $response = \Illuminate\Support\Facades\Response::make($file, 200);
//    $response->header("Content-Type", "image/jpg");
//  return $response;



Route::get('test',function (){
   return Auth::user();
})->name('test');



/////// POST Requests //

Route::post('/register',[RegisterController::class,'register']);
Route::post('/login',[LoginController::class,'login']);
Route::post('/logout',[LoginController::class,'logout']);

/////// PATCH Requests //

Route::patch('changeData/users/{user_id}',[UserDataController::class,'changeData']);

