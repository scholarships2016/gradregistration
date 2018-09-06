<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblFaculty
 *
 * @property string $faculty_id
 * @property string $faculty_name
 * @property string $faculty_eng
 * @property int $fac_sort
 * @property string $faculty_full
 *
 * @package App\Models
 */
class TblFaculty extends Eloquent
{
	protected $table = 'tbl_faculty';
	protected $primaryKey = 'faculty_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'fac_sort' => 'int'
	];

	protected $fillable = [
		'faculty_name',
		'faculty_eng',
		'fac_sort',
		'faculty_full',
		'is_active'
	];
}
