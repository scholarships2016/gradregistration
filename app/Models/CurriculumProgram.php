<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 22 Jul 2017 14:18:46 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CurriculumProgram
 * 
 * @property int $curr_prog_id
 * @property int $curriculum_id
 * @property int $program_id
 * @property int $program_type_id
 * @property int $program_plan_id
 * @property string $coursecodeno
 *
 * @package App\Models
 */
class CurriculumProgram extends Eloquent
{
	protected $table = 'curriculum_program';
	protected $primaryKey = 'curr_prog_id';
	public $timestamps = false;

	protected $casts = [
		'curriculum_id' => 'int',
		'program_id' => 'int',
		'program_type_id' => 'int',
		'program_plan_id' => 'int'
	];

	protected $fillable = [
		'curriculum_id',
		'program_id',
		'program_type_id',
		'program_plan_id',
		'coursecodeno'
	];
}
