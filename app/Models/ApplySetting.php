<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 29 Jul 2017 23:39:04 +0700.
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
 * @property int $is_active
 * @property int $status
 * @property \Carbon\Carbon $created
 * @property string $creator
 * @property \Carbon\Carbon $modified
 * @property string $modifier
 *
 * @package App\Models
 */
class ApplySetting extends Eloquent
{
	protected $table = 'apply_setting';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'apply_setting_id' => 'int',
		'semester' => 'int',
		'round_no' => 'int',
		'is_active' => 'int',
		'status' => 'int'
	];

	protected $dates = [
		'start_date',
		'end_date',
		'created',
		'modified'
	];

	protected $fillable = [
		'apply_setting_id',
		'semester',
		'academic_year',
		'round_no',
		'start_date',
		'end_date',
		'is_active',
		'status',
		'created',
		'creator',
		'modified',
		'modifier'
	];
}
