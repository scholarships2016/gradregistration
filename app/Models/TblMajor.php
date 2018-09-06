<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblMajor
 *
 * @property string $major_id
 * @property string $major_name
 * @property string $major_name_en
 * @property string $department_id
 *
 * @package App\Models
 */
class TblMajor extends Eloquent
{
	protected $table = 'tbl_major';
	protected $primaryKey = 'major_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'major_name',
		'major_name_en',
		'department_id',
		'is_active'
	];
}
