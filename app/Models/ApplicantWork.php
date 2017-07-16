<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 13 Jul 2017 15:57:23 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ApplicantWork
 *
 * @property int $app_work_id
 * @property int $applicant_id
 * @property string $work_stu_phone
 * @property string $work_status_id
 * @property string $work_stu_detail
 * @property string $work_stu_position
 * @property string $work_stu_yr
 * @property string $work_stu_mth
 * @property string $work_stu_salary
 * @property bool $app_work_status
 * @property string $creator
 * @property \Carbon\Carbon $created
 * @property string $modifier
 * @property \Carbon\Carbon $modified
 *
 * @package App\Models
 */
class ApplicantWork extends Eloquent
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table = 'applicant_work';
    protected $primaryKey = 'app_work_id';
    public $timestamps = true;

    protected $casts = [
        'applicant_id' => 'int',
        'app_work_status' => 'bool'
    ];

    protected $dates = [
        'created',
        'modified'
    ];

    protected $fillable = [
        'applicant_id',
        'work_stu_phone',
        'work_status_id',
        'work_stu_detail',
        'work_stu_position',
        'work_stu_yr',
        'work_stu_mth',
        'work_stu_salary',
        'app_work_status',
        'creator',
        'created',
        'modifier',
        'modified'
    ];
}
