<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 22 Jul 2017 14:18:46 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblProgramType
 * 
 * @property int $program_type_id
 * @property string $prog_type_name
 * @property string $prog_type_name_en
 * @property string $cond_id
 * @property string $degree_lavel_name
 * @property string $office_time
 *
 * @package App\Models
 */
class TblProgramType extends Eloquent
{
	protected $table = 'tbl_program_type';
	protected $primaryKey = 'program_type_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'program_type_id' => 'int'
	];

	protected $fillable = [
		'prog_type_name',
		'prog_type_name_en',
		'cond_id',
		'degree_lavel_name',
		'office_time'
	];
}
