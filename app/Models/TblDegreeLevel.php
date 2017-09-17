<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 17 Sep 2017 06:50:16 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblDegreeLevel
 * 
 * @property string $degree_level_id
 * @property string $degree_level_ref
 * @property string $degree_level_name
 * @property string $degree_level_name_en
 *
 * @package App\Models
 */
class TblDegreeLevel extends Eloquent
{
	protected $table = 'tbl_degree_level';
	protected $primaryKey = 'degree_level_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'degree_level_ref',
		'degree_level_name',
		'degree_level_name_en'
	];
}
