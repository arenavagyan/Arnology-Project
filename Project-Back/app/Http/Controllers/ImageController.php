<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(ImageRequest $request){
      $file = $request->file('image');
      $path = $file->store('images', 'public');
      $image = new Image();
      $image->path = $path;
      $image->save();
      return response()->json(['message' => 'Image uploaded successfully.','path' => $path],200);
    }
}
