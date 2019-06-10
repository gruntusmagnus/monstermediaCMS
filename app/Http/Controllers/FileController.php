<?php

namespace App\Http\Controllers;


class FileController extends Controller
{
    public function downloadFile($modelName,$fileId){
        $file = \App\File::findOrFail($fileId);
        $dirname= strtolower($modelName);
        return response()->download(storage_path("files/$dirname/$file->fileable_id/$fileId.$file->ext"));
    }

    public function deleteFile($modelName,$fileId){
        $dirname = strtolower(($modelName));
        $file = \App\File::findOrFail($fileId);
                $filepath = storage_path("files/$dirname/$file->fileable_id/$fileId.$file->ext");

            \File::delete($filepath);
            $file->delete();

        return \Redirect::back();
    }
}

