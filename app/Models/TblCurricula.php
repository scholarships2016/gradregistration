<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 24 Jun 2017 00:15:58 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblCurricula
 * 
 * @property int $id
 * @property float $curricula_id
 * @property string $curricula_name
 * @property int $department_id
 *
 * @package App\Models
 */
class TblCurricula extends Eloquent
{
	protected $table = 'tbl_curricula';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'curricula_id' => 'float',
		'department_id' => 'int'
	];

	protected $fillable = [
		'curricula_id',
		'curricula_name',
		'department_id'
	];
}
