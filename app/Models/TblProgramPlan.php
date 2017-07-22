<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 22 Jul 2017 22:38:49 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblProgramPlan
 * 
 * @property int $program_plan_id
 * @property string $prog_plan_name
 * @property string $prog_plan_name_en
 * @property string $prog_plan_desc1
 * @property string $prog_plan_desc2
 *
 * @package App\Models
 */
class TblProgramPlan extends Eloquent
{
	protected $table = 'tbl_program_plan';
	protected $primaryKey = 'program_plan_id';
	public $timestamps = false;

	protected $fillable = [
		'prog_plan_name',
		'prog_plan_name_en',
		'prog_plan_desc1',
		'prog_plan_desc2'
	];
}
