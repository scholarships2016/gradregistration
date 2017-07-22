<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 22 Jul 2017 22:38:49 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblMajor
 * 
 * @property int $major_id
 * @property float $major_code
 * @property string $major_name
 * @property string $major_name_en
 * @property int $department_id
 *
 * @package App\Models
 */
class TblMajor extends Eloquent
{
	protected $table = 'tbl_major';
	protected $primaryKey = 'major_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'major_id' => 'int',
		'major_code' => 'float',
		'department_id' => 'int'
	];

	protected $fillable = [
		'major_code',
		'major_name',
		'major_name_en',
		'department_id'
	];
}
