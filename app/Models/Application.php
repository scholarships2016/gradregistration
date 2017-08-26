<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Application
 * 
 * @property int $application_id
 * @property int $applicant_id
 * @property string $stu_citizen_card
 * @property int $curr_act_id
 * @property int $curriculum_id
 * @property string $program_id
 * @property int $curr_prog_id
 * @property string $sub_major_id
 * @property int $app_id
 * @property int $curriculum_num
 * @property int $flow_id
 * @property int $bank_id
 * @property \Carbon\Carbon $payment_date
 * @property string $receipt_book
 * @property string $receipt_no
 * @property int $exam_status
 * @property string $exam_remark
 * @property string $admission_status_id
 * @property string $admission_remark
 * @property string $additional_answer
 * @property string $special_apply_by
 * @property \Carbon\Carbon $special_apply_datetime
 * @property string $special_apply_comment
 * @property string $special_admission_by
 * @property \Carbon\Carbon $special_admission_date
 * @property string $spacial_admission_comment
 * @property string $creator
 * @property \Carbon\Carbon $created
 * @property string $modifier
 * @property \Carbon\Carbon $modified
 *
 * @package App\Models
 */
class Application extends Eloquent {

    protected $table = 'application';
    protected $primaryKey = 'application_id';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public $timestamps = true;
    protected $casts = [
        'applicant_id' => 'int',
        'curr_act_id' => 'int',
        'curriculum_id' => 'int',
        'curr_prog_id' => 'int',
        'app_id' => 'int',
        'curriculum_num' => 'int',
        'flow_id' => 'int',
        'bank_id' => 'int',
        'exam_status' => 'int'
    ];
    protected $dates = [
        'payment_date',
        'special_apply_datetime',
        'special_admission_date',
        'created',
        'modified'
    ];
    protected $fillable = [
        'applicant_id',
        'stu_citizen_card',
        'curr_act_id',
        'curriculum_id',
        'program_id',
        'curr_prog_id',
        'sub_major_id',
        'app_id',
        'curriculum_num',
        'flow_id',
        'bank_id',
        'payment_date',
        'receipt_book',
        'receipt_no',
        'exam_status',
        'exam_remark',
        'admission_status_id',
        'admission_remark',
        'additional_answer',
        'special_apply_by',
        'special_apply_datetime',
        'special_apply_comment',
        'special_admission_by',
        'special_admission_date',
        'spacial_admission_comment',
        'creator',
        'created',
        'modifier',
        'modified'
    ];

}
