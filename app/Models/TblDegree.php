<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblDegree
 *
 * @property string $degree_id
 * @property string $degree_name
 * @property string $degree_name_en
 *
 * @package App\Models
 */
class TblDegree extends Eloquent
{
	protected $table = 'tbl_degree';
	protected $primaryKey = 'degree_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'degree_name',
		'degree_name_en',
		'is_active'
	];
}
