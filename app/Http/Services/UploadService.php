<?php


namespace App\Http\Services;

class UploadService
{
    public function makeDirectoryForFile($model)
    {
        \File::makeDirectory(storage_path($this->fileDirectory($model)), 0775, true);
    }

    public function deleteDirectoryForFile($model)
    {
        \File::deleteDirectory(storage_path($this->fileDirectory($model)));
    }

    public function makeDirectoryForImage($model)
    {
        \File::makeDirectory(storage_path($this->imageDirectory($model)), 0775, true);
    }

    public function deleteDirectoryForImage($model)
    {
        \File::deleteDirectory(storage_path($this->imageDirectory($model)));
    }

    public function saveFiles($model, $files)
    {
        if ($files) foreach ($files as $file) {
            $this->saveFile($model, $file);
        }
    }

    public function saveFile($model, $file)
    {
        if (!$file || !$file->isValid()) null;

        $createdFile = $this->addFileToDatabase($file, $model);

        $filepath = $this->fileDirectory($model);

        if(!(\File::exists($filepath))){
            $this->makeDirectoryForFile($model);
        }

        $filename = $createdFile->id.'.'.$file->getClientOriginalExtension();

        //save the file
        $file->move($filepath, $filename);

        //add file to database
        return $createdFile;//
    }

    public function addFileToDatabase($file, $model)
    {

        return \App\File::create([
            'fileable_id' => $model->id,
            'fileable_type' => get_class($model),
            'name' => $file->getClientOriginalName(),
            'mime' => $file->getClientMimeType(),
            'ext' => $file->getClientOriginalExtension(),
            'size' => $file->getClientSize(),
        ]);
    }

    public function saveImages($model,$images){
        if ($images) foreach ($images as $image) {
            $this->saveImage($model, $image);
        }
    }

    public function saveImage($model, $image)
    {
        if (!$image || !$image->isValid()) null;

        $createdImage = $this->addImageToDatabase($image, $model);

        $filepath = $this->imageDirectory($model);

        if(!(\File::exists($filepath))){
            $this->makeDirectoryForImage($model);
        }
        $filename = $createdImage->id.'.'.$image->getClientOriginalExtension();

        //save the file
        $image->move($filepath, $filename);

        //add file to database
        return $createdImage;//
    }

    public function addImageToDatabase($image,$model){
        return \App\Image::create([
            'imageable_id' => $model->id,
            'imageable_type' => get_class($model),
            'ext' => $image->getClientOriginalExtension(),
        ]);
    }

    public function fileDirectory($model){
        $dirname = strtolower(class_basename($model));
        return storage_path("files/$dirname/{$model->id}/");
    }
    public function imageDirectory($model){
        $dirname = strtolower(class_basename($model));
        return storage_path("images/$dirname/{$model->id}/");
    }


}
