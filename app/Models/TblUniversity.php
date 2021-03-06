<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblUniversity
 * 
 * @property string $university_id
 * @property string $university_code
 * @property string $university_name
 * @property string $university_name_en
 * @property float $university_type
 *
 * @package App\Models
 */
class TblUniversity extends Eloquent
{
	protected $table = 'tbl_university';
	protected $primaryKey = 'university_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'university_type' => 'float'
	];

	protected $fillable = [
		'university_code',
		'university_name',
		'university_name_en',
		'university_type'
	];
}
