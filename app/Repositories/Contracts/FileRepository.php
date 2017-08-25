<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\UploadedFile;

interface FileRepository
{

    //Generate Name
    public function upload(UploadedFile $uploadedFile, $path = null);

    public function uploadWithName(UploadedFile $uploadedFile, $newFilename, $path = null);

    public function forceRemoveById($id);

    public function removeToTrashById($id);

    public function getContentFileById($id);

    public function getImageFileAsBase64ById($id);

    public function justUpload(UploadedFile $uploadedFile, $path = null);

    public function justUploadWithName(UploadedFile $uploadedFile, $newFilename, $path = null);

    public function removeFileByPath($path);

}
 

 
