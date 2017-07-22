<?php

namespace App\Repositories;

use App\Repositories\Contracts\ApplicationDocumentFileRepository;
use App\Models\ApplicationDocumentFile;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;
use App\Repositories\FileRepositoryImpl;

class ApplicationDocumentFileRepositoryImpl extends AbstractRepositoryImpl implements ApplicationDocumentFileRepository {

    protected $ApplicationDocumentFileRepo;
    protected $fileRepo;
    private $paging = 10;

    public function __construct(FileRepositoryImpl $fileRepo) {
        parent::setModelClassName(ApplicationDocumentFile::class);
        $this->fileRepo = $fileRepo;
    }

    public function GetData($application_ID) {
        $result = null;
        try {
            $result = ApplicationDocumentFile::leftJoin('file', 'file.file_id', 'application_document_file.file_id')
                    ->Where('application_id', $application_ID)
                    ->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function DeleteNOTIN($application_ID, $doc_apply_id) {
        $result = null;
        $resFile = null;
        try {
            $resFile = ApplicationDocumentFile::Where('application_id', $application_ID)
                            ->whereNotIn('doc_apply_id', $doc_apply_id)->select('file_id')->get();
            foreach ($resFile as $resf) {
                $this->fileRepo->forceRemoveById($resf->file_id);
            }

            $result = ApplicationDocumentFile::Where('application_id', $application_ID)
                    ->whereNotIn('doc_apply_id', $doc_apply_id)
                    ->delete();
        } catch (\Exception $ex) {

            throw $ex;
        }
        return $result;
    }

    public function saveApplicationDocumentFile($data) {
        $result = false;
        $resFile = null;
        try {

            $curObj = new ApplicationDocumentFile;

            $resFile = ApplicationDocumentFile::Where('application_id', $data['application_id'])
                            ->Where('doc_apply_id', $data['doc_apply_id'])->get();
            foreach ($resFile as $resf) {
                $this->fileRepo->forceRemoveById($resf->file_id);
            }
            ApplicationDocumentFile::Where('application_id', $data['application_id'])
                    ->Where('doc_apply_id', $data['doc_apply_id'])
                    ->delete();

            $curObj->application_id = $data['application_id'];

            $curObj->doc_apply_id = $data['doc_apply_id'];

            $curObj->file_id = $data['file_id'];

            $curObj->other_val = $data['other_val'];

            $result = $curObj->save();
        } catch (\Exception $ex) {

            $result = false;
            throw $ex;
        }


        return $result;
    }

}
