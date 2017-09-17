<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Curriculum
 *
 * @property int $curriculum_id
 * @property string $faculty_id
 * @property string $department_id
 * @property string $major_id
 * @property string $degree_id
 * @property int $project_id
 * @property string $apply_method
 * @property string $responsible_person
 * @property string $additional_detail
 * @property string $apply_fee
 * @property string $additional_question
 * @property string $mailing_address
 * @property string $document_file
 * @property string $comm_appr_name
 * @property string $comm_appr_no
 * @property \Carbon\Carbon $comm_appr_date
 * @property string $contact_tel
 * @property bool $status
 * @property string $creator
 * @property \Carbon\Carbon $created
 * @property string $modifier
 * @property \Carbon\Carbon $modified
 *
 * @package App\Models
 */
class Curriculum extends Eloquent
{

    protected $table = 'curriculum';
    protected $primaryKey = 'curriculum_id';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public $timestamps = true;
    protected $casts = [
        'faculty_id' => 'int',
        'department_id' => 'int',
        'degree_id' => 'int',
        'project_id' => 'int',
        'is_approve' => 'int',
        'status' => 'bool',
        'expected_amount' => 'int'
    ];
    protected $dates = [
        'comm_appr_date',
        'created',
        'modified'
    ];
    protected $fillable = [
        'faculty_id',
        'department_id',
        'major_id',
        'degree_id',
        'project_id',
        'apply_method',
        'responsible_person',
        'additional_detail',
        'apply_fee',
        'additional_question',
        'mailing_address',
        'document_file',
        'comm_appr_name',
        'comm_appr_no',
        'comm_appr_date',
        'contact_tel',
        'is_approve',
        'status',
        'creator',
        'created',
        'modifier',
        'modified',
        'expected_amount'
    ];

    public function file()
    {
        return $this->hasOne(File::class, 'file_id', 'document_file');
    }

    public function curriculumUsers()
    {
        return $this->hasMany(CurriculumUser::class, 'curriculum_id', 'curriculum_id');
    }

}
