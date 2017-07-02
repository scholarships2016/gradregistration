<?php

namespace App\Repositories;

use App\Models\ApplicantNewsSource;
use App\Repositories\Contracts\ApplicantNewsSourceRepository;


class ApplicantNewsSourceRepositoryImpl extends AbstractRepositoryImpl implements ApplicantNewsSourceRepository
{

    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(ApplicantNewsSource::class);
    }

    public function getApplicantNewsSourceByApplicantId($applicantId)
    {
        try {
            return ApplicantNewsSource::where('applicant_id', '=', $applicantId)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function updateSetOfApplicantNewsSrc(array $data)
    {
        try {
            if (!array_key_exists('applicant_id', $data) || empty($data['applicant_id'])) {
                return;
            }
            $deletedRows = ApplicantNewsSource::where('applicant_id', '=', $data['applicant_id'])->delete();
            if (array_key_exists('app_news_id', $data)) {
                foreach ($data['app_news_id'] as $id) {
                    $this->create(array('news_source_id' => $id, 'applicant_id' => $data['applicant_id']));
                }
            }
            return true;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


}
