<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 23 Jul 2017 20:32:39 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblDepartment
 * 
 * @property int $department_id
 * @property string $department_name
 * @property int $department_name_en
 * @property int $faculty_id
 *
 * @package App\Models
 */
class TblDepartment extends Eloquent
{
	protected $table = 'tbl_department';
	protected $primaryKey = 'department_id';
	public $timestamps = false;

	protected $casts = [
		'department_name_en' => 'int',
		'faculty_id' => 'int'
	];

	protected $fillable = [
		'department_name',
		'department_name_en',
		'faculty_id'
	];
}
