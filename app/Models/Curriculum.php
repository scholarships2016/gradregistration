<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 16 Jul 2017 15:05:21 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Curriculum
 * 
 * @property int $curriculum_id
 * @property int $faculty_id
 * @property int $department_id
 * @property int $degree_id
 * @property int $project_id
 * @property string $apply_method
 * @property string $responsible_person
 * @property string $addtional_detail
 * @property string $apply_fee
 * @property string $addtional_question
 * @property string $mailing_address
 * @property string $document_file
 * @property string $comm_appr_name
 * @property string $comm_appr_no
 * @property \Carbon\Carbon $comm_appr_date
 * @property string $contact_tel
 * @property bool $is_approve
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
	public $timestamps = false;

	protected $casts = [
		'faculty_id' => 'int',
		'department_id' => 'int',
		'degree_id' => 'int',
		'project_id' => 'int',
		'is_approve' => 'bool',
		'status' => 'bool'
	];

	protected $dates = [
		'comm_appr_date',
		'created',
		'modified'
	];

	protected $fillable = [
		'faculty_id',
		'department_id',
		'degree_id',
		'project_id',
		'apply_method',
		'responsible_person',
		'addtional_detail',
		'apply_fee',
		'addtional_question',
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
		'modified'
	];
}
