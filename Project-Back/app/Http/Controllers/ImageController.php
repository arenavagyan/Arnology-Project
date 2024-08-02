<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageIdRequest;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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

    public function setUserImage($imagePath){

        $user = Auth::user();
        $user->image = $imagePath;
        $user->save();
        return response()->json($user->image , 200);
    }

    public function getUserAvatar()
    {

      $user = Auth::user();
      $imageName = $user->image;
        if($imageName){
            return $imageName;
        }
       return null;

    }

    public function imageFileGetter($imageName){


        $file = File::get( storage_path('app/public/images/').$imageName);
        $response = Response::make($file, 200);
        $mimeType = File::mimeType(storage_path('app/public/images/').$imageName);
        $response->header("Content-Type", $mimeType);
        return $response;

    }
}
