<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 24 Jun 2017 00:11:18 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblProject
 * 
 * @property string $project_id
 * @property string $project_name
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
		'project_name'
	];
}
