<?php

namespace App\Repositories;

use App\Models\Announcement;
use App\Repositories\Contracts\AnnouncementRepository;

class AnnouncementRepositoryImpl extends AbstractRepositoryImpl implements AnnouncementRepository {

    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblDistrict::class);
    }

    public function getAnnouncementAll() {
        $res = null;
        try {
            $res = Announcement::orderBy('anno_seq')->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $res;
    }

    public function delete($id) {
        $result = false;
        try {
            $result = TblDegree::where('anno_id', $id)->delete();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function saveAnnouncement($data) {
        $result = false;
        try {
            $id = null;

            if (array_key_exists('anno_id', $data) || !empty($data['anno_id']))
                $id = $data['anno_id'];

            $chk = Announcement::where('anno_id', $id)->first();
            $curObj = $chk ? $chk : new Announcement;
            if (array_key_exists('anno_title', $data))
                $curObj->anno_title = $data['anno_title'];
            if (array_key_exists('anno_detail', $data))
                $curObj->anno_detail = $data['anno_detail'];
            if (array_key_exists('anno_flag', $data))
                $curObj->anno_flag = $data['anno_flag'];


            if (!$chk) {
//                if (array_key_exists('stu_citizen_card', $data))
//                    $curObj->creator = $data['stu_citizen_card'];

                $curObj->created = \Carbon\Carbon::now()->timestamp;
            }

//            if (array_key_exists('modifier', $data))
//                $curObj->modifier = $data['modifier'];

            $curObj->modifier = \Carbon\Carbon::now()->timestamp;
            $result = $curObj->save();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

}
