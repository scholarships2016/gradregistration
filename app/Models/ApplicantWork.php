<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 25 Jun 2017 18:28:04 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ApplicantWork
 * 
 * @property int $work_stu_id
 * @property int $applicant_id
 * @property string $work_stu_phone
 * @property string $work_status_id
 * @property string $work_stu_detail
 * @property string $work_stu_position
 * @property string $work_stu_yr
 * @property string $work_stu_mth
 * @property string $work_stu_salary
 * @property string $creator
 * @property \Carbon\Carbon $created
 * @property string $modifier
 * @property \Carbon\Carbon $modified
 *
 * @package App\Models
 */
class ApplicantWork extends Eloquent
{
	protected $table = 'applicant_work';
	protected $primaryKey = 'work_stu_id';
	public $timestamps = false;

	protected $casts = [
		'applicant_id' => 'int'
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
		'creator',
		'created',
		'modifier',
		'modified'
	];
}
