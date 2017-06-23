<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 23 Jun 2017 16:49:15 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblDegree
 * 
 * @property int $degree_id
 * @property string $degree_name
 * @property string $degree_name_en
 *
 * @package App\Models
 */
class TblDegree extends Eloquent
{
	protected $table = 'tbl_degree';
	protected $primaryKey = 'degree_id';
	public $timestamps = false;

	protected $fillable = [
		'degree_name',
		'degree_name_en'
	];
}
