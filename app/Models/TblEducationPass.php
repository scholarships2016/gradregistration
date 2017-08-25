<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblEducationPass
 * 
 * @property string $edu_pass_id
 * @property string $edu_pass_name
 * @property string $edu_pass_name_en
 *
 * @package App\Models
 */
class TblEducationPass extends Eloquent
{
	protected $table = 'tbl_education_pass';
	protected $primaryKey = 'edu_pass_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'edu_pass_name',
		'edu_pass_name_en'
	];
}
