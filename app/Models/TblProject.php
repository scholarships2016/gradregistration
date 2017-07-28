<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 23 Jul 2017 20:32:40 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblProject
 * 
 * @property string $project_id
 * @property string $project_name
 * @property string $project_name_en
 *
 * @package App\Models
 */
class TblProject extends Eloquent
{
	protected $table = 'tbl_project';
	protected $primaryKey = 'project_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'project_name',
		'project_name_en'
	];
}
