<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageIdRequest;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function upload(ImageRequest $request){
      $file = $request->file('image');
      $path = $file->store('images', 'public');
      $image = new Image();
      $image->path = $path;
      $image->save();
      return response()->json($image->path,200);
    }

    public function setUserImage($imagePath,$id){

        $user = Auth::user();
        $user->image = $imagePath;
        $user->save();
        return response()->json($user , 200);
    }

    public function getImage($imageId){
        $image = Image::findorFail($imageId);
        $path = storage_path('app/public/' . $image->path);

        if(file_exists($path)){
            return response()->file($path);
        }
        abort(404);
    }
}
