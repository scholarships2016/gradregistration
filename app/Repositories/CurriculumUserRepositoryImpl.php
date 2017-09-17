<?php

namespace App\Repositories;


use App\Models\CurriculumUser;
use App\Repositories\Contracts\CurriculumUserRepository;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class CurriculumUserRepositoryImpl extends AbstractRepositoryImpl implements CurriculumUserRepository
{
    /**
     * CurriculumUserRepositoryImpl constructor.
     */
    public function __construct()
    {
        parent::setModelClassName(CurriculumUser::class);
    }

    public function save(array $data)
    {
        try {
            $obj = (array_key_exists('curr_user_id', $data) && !empty($data['curr_user_id'])) ? $this->find($data['curr_user_id']) : new CurriculumUser();
            if (empty($obj)) {
                $obj = new CurriculumUser();
            }
            if (array_key_exists('curriculum_id', $data)) {
                $obj->curriculum_id = $data['curriculum_id'];
            }
            if (array_key_exists('user_id', $data)) {
                $obj->user_id = $data['user_id'];
            }
            if (array_key_exists('creator', $data)) {
                $obj->creator = $data['creator'];
            }

            $obj->save();
            return $obj;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function removeCurrUserNotInListByCurriculumId(array $ids, $curriculumId)
    {
        try {
            return CurriculumUser::whereNotIn('user_id', $ids)->where('curriculum_id', $curriculumId)->delete();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function removeCurrUserByCurriculumId($curriculumId)
    {
        try {
            return CurriculumUser::where('curriculum_id', $curriculumId)->delete();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
