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
      $name = $request->name;
      $image = new Image();
      $image->path = $path;
      $image->image_name = $name;
      $image->save();
      return response()->json($image->path,200);
    }

    public function     setUserImage($imagePath){

        $user = Auth::user();
        $user->image = $imagePath;
        $user->save();
        return response()->json($imagePath , 200);
    }

    public function getImage($imageName){
        $imagePath = 'images/'.$imageName;
        $image = Image::where('path',$imagePath)->first();
        if(file_exists($image)){
            return response()->json($image->image_name);
        }
        abort(404);
    }

    public function getUserAvatar()
    {
      $user = Auth::user();
      $imageName = $user->image;
        $imagePath = 'images/'.$imageName;
        $image = Image::where('path',$imagePath)->first();
        $path = storage_path('app/public/' . $image->path);
        if(file_exists($path)){
            return response()->json($image->image_name);
        }
        abort(404);

    }
}
