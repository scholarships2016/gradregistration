<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 29 Jul 2017 23:39:04 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblStatus
 * 
 * @property string $status_id
 * @property string $status_name
 * @property string $status_name_en
 *
 * @package App\Models
 */
class TblStatus extends Eloquent
{
	protected $table = 'tbl_status';
	protected $primaryKey = 'status_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'status_name',
		'status_name_en'
	];
}
