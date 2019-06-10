<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Database\Eloquent\Model;

class ImageController extends Controller
{
    public function show($imageId,$slug) {
        $image = Image::findOrFail($imageId);
        $dirname = strtolower(class_basename($image->imageable));
        return storage_path("images/$dirname/$image->fileable_id/$imageId.$image->ext");
    }

    public function downloadImage($modelName,$imageId){
        $image = Image::findOrFail($imageId);
        $dirname= strtolower($modelName);
        return response()->download(storage_path("images/$dirname/$image->fileable_id/$imageId.$image->ext"));
    }

    public function deleteImage($modelName,$imageId){

        $dirname = strtolower(($modelName));
        $image = Image::findOrFail($imageId);
        $filepath = storage_path("images/$dirname/$image->fileable_id/$imageId.$image->ext");

        \File::delete($filepath);
        $image->delete();

        return \Redirect::back();


    }
}
