<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 22 Jul 2017 14:18:46 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ApplySetting
 * 
 * @property int $apply_setting_id
 * @property int $semester
 * @property string $academic_year
 * @property int $round_no
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $end_date
 *
 * @package App\Models
 */
class ApplySetting extends Eloquent
{
	protected $table = 'apply_setting';
	protected $primaryKey = 'apply_setting_id';
	public $timestamps = false;

	protected $casts = [
		'semester' => 'int',
		'round_no' => 'int'
	];

	protected $dates = [
		'start_date',
		'end_date'
	];

	protected $fillable = [
		'semester',
		'academic_year',
		'round_no',
		'start_date',
		'end_date'
	];
}
