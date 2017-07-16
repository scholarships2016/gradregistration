<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 16 Jul 2017 15:05:21 +0700.
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
 * @property int $program_id
 * @property int $sub_major_id
 * @property int $app_id
 * @property int $curriculum_num
 * @property int $flow_id
 * @property string $creator
 * @property \Carbon\Carbon $created
 * @property string $modifier
 * @property \Carbon\Carbon $modified
 *
 * @package App\Models
 */
class Application extends Eloquent
{
	protected $table = 'application';
	protected $primaryKey = 'application_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'application_id' => 'int',
		'applicant_id' => 'int',
		'curr_act_id' => 'int',
		'curriculum_id' => 'int',
		'program_id' => 'int',
		'sub_major_id' => 'int',
		'app_id' => 'int',
		'curriculum_num' => 'int',
		'flow_id' => 'int'
	];

	protected $dates = [
		'created',
		'modified'
	];

	protected $fillable = [
		'applicant_id',
		'stu_citizen_card',
		'curr_act_id',
		'curriculum_id',
		'program_id',
		'sub_major_id',
		'app_id',
		'curriculum_num',
		'flow_id',
		'creator',
		'created',
		'modifier',
		'modified'
	];
}
