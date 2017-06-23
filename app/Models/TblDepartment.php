<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 23 Jun 2017 20:02:58 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblDepartment
 * 
 * @property int $department_id
 * @property string $department_name
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
		'faculty_id' => 'int'
	];

	protected $fillable = [
		'department_name',
		'faculty_id'
	];
}
