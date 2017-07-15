<?php

namespace App\Repositories;

use App\Models\File;
use App\Repositories\Contracts\FileRepository;
use App\Utils\Util;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileRepositoryImpl extends AbstractRepositoryImpl implements FileRepository
{


    public function __construct()
    {
        parent::setModelClassName(File::class);
    }

    public function upload(UploadedFile $uploadedFile, $path = null)
    {
        DB::beginTransaction();
        try {
            $file = new File;
            $file->file_origi_name = $uploadedFile->getClientOriginalName();
            $file->file_ext = $uploadedFile->getClientOriginalExtension();
            $file->file_size = $uploadedFile->getSize();
            $file->file_mimetype = $uploadedFile->getClientMimeType();
            $genName = Storage::putFile(empty($path) ? env(Util::TEMP_FOLDER) : $path, $uploadedFile);
            $file->file_path = $genName;
            $filenameArr = explode("/", $genName);
            $file->file_gen_name = $filenameArr[sizeof($filenameArr) - 1];
            $file->save();
            DB::commit();
            return $file;
        } catch (\Exception $ex) {
            DB::rollBack();
        }
    }

    public function uploadWithName(UploadedFile $uploadedFile, $newFilename, $path = null)
    {
        DB::beginTransaction();
        try {
            $file = new File;
            $file->file_origi_name = $uploadedFile->getClientOriginalName();
            $file->file_ext = $uploadedFile->getClientOriginalExtension();
            $file->file_size = $uploadedFile->getSize();
            $file->file_mimetype = $uploadedFile->getClientMimeType();
            $genName = Storage::putFileAs(empty($path) ? env(Util::TEMP_FOLDER) : $path, $uploadedFile, $newFilename);
            $file->file_path = $genName;
            $filenameArr = explode("/", $genName);
            $file->file_gen_name = $filenameArr[sizeof($filenameArr) - 1];
            $file->save();
            DB::commit();
            return $file;
        } catch (\Exception $ex) {
            DB::rollBack();
        }
    }

    public function forceRemoveById($id)
    {
        DB::beginTransaction();
        try {
            $file = $this->find($id);
            if (empty($file)) {
                new \Exception('Not Found');
            }
            if (Storage::delete($file->file_path)) {
                $file->delete();
            }
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeToTrashById($id)
    {
        // TODO: Implement removeToTrash() method.
    }

    public function getContentFileById($id)
    {
        try {
            $result = $this->find($id);
            if (empty($result)) {
                throw new \Exception('Not Found');
            }
            return array("file" => $result, "content" => Storage::get($result->file_path));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getImageFileAsBase64ById($id)
    {
        try {
            $result = File::where('file_id', '=', $id)
                ->where('file_mimetype', 'like', 'image%');

            if (empty($result)) {
                throw new \Exception('Not Found');
            }
            return 'data:image/*' . ';base64,' . base64_encode(Storage::get($result->file_path));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
