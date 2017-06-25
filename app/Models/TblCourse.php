<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 25 Jun 2017 13:09:02 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblCourse
 * 
 * @property string $course_id
 * @property string $course_name
 * @property int $curricula_id
 *
 * @package App\Models
 */
class TblCourse extends Eloquent
{
	protected $table = 'tbl_course';
	protected $primaryKey = 'course_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'curricula_id' => 'int'
	];

	protected $fillable = [
		'course_name',
		'curricula_id'
	];
}
