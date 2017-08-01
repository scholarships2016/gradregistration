<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblSemester
 * 
 * @property int $semester_id
 * @property string $semester_name_th
 * @property string $semester_name_en
 *
 * @package App\Models
 */
class TblSemester extends Eloquent
{
	protected $table = 'tbl_semester';
	protected $primaryKey = 'semester_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'semester_id' => 'int'
	];

	protected $fillable = [
		'semester_name_th',
		'semester_name_en'
	];
}
