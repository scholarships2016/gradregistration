<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 20 Jun 2017 23:10:20 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblDegree
 * 
 * @property string $degret_id
 * @property string $degret_name
 * @property string $degret_name_eng
 *
 * @package App\Models
 */
class TblDegree extends Eloquent
{
	protected $table = 'tbl_degree';
	protected $primaryKey = 'degret_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'degret_name',
		'degret_name_eng'
	];
}
