<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
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
