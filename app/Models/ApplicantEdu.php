<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 24 Jun 2017 00:15:58 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ApplicantEdu
 * 
 * @property int $edu_id
 * @property string $stu_citizen_card
 * @property int $grad_level_id
 * @property string $edu_pass_id
 * @property string $university_id
 * @property string $edu_year
 * @property string $edu_faculty
 * @property string $edu_major
 * @property string $edu_gpax
 * @property string $edu_degree
 * @property string $creator
 * @property \Carbon\Carbon $created
 * @property string $modifier
 * @property \Carbon\Carbon $modified
 *
 * @package App\Models
 */
class ApplicantEdu extends Eloquent
{
	protected $table = 'applicant_edu';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'edu_id' => 'int',
		'grad_level_id' => 'int'
	];

	protected $dates = [
		'created',
		'modified'
	];

	protected $fillable = [
		'edu_id',
		'stu_citizen_card',
		'grad_level_id',
		'edu_pass_id',
		'university_id',
		'edu_year',
		'edu_faculty',
		'edu_major',
		'edu_gpax',
		'edu_degree',
		'creator',
		'created',
		'modifier',
		'modified'
	];
}
