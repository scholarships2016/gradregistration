<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 20 Jun 2017 23:10:20 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblWorkStatus
 * 
 * @property string $work_status_id
 * @property string $work_status_name
 * @property string $work_status_name_en
 *
 * @package App\Models
 */
class TblWorkStatus extends Eloquent
{
	protected $table = 'tbl_work_status';
	protected $primaryKey = 'work_status_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'work_status_name',
		'work_status_name_en'
	];
}
