<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 29 Jun 2017 14:04:56 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblCurricula
 * 
 * @property int $curricula_id
 * @property float $curricula_code
 * @property string $curricula_name
 * @property string $curricula_name_en
 * @property int $department_id
 *
 * @package App\Models
 */
class TblCurricula extends Eloquent
{
	protected $table = 'tbl_curricula';
	protected $primaryKey = 'curricula_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'curricula_id' => 'int',
		'curricula_code' => 'float',
		'department_id' => 'int'
	];

	protected $fillable = [
		'curricula_code',
		'curricula_name',
		'curricula_name_en',
		'department_id'
	];
}
