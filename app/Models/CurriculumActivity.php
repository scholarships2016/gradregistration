<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 16 Jul 2017 15:05:21 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CurriculumActivity
 * 
 * @property int $curr_act_id
 * @property int $curriculum_id
 * @property int $apply_setting_id
 * @property string $exam_schedule
 * @property \Carbon\Carbon $announce_exam_date
 * @property \Carbon\Carbon $announce_admission_date
 * @property \Carbon\Carbon $orientation_date
 * @property string $orientation_location
 * @property int $expected_amount
 *
 * @package App\Models
 */
class CurriculumActivity extends Eloquent
{
	protected $table = 'curriculum_activity';
	protected $primaryKey = 'curr_act_id';
	public $timestamps = false;

	protected $casts = [
		'curriculum_id' => 'int',
		'apply_setting_id' => 'int',
		'expected_amount' => 'int'
	];

	protected $dates = [
		'announce_exam_date',
		'announce_admission_date',
		'orientation_date'
	];

	protected $fillable = [
		'curriculum_id',
		'apply_setting_id',
		'exam_schedule',
		'announce_exam_date',
		'announce_admission_date',
		'orientation_date',
		'orientation_location',
		'expected_amount'
	];
}
