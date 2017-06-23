<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 23 Jun 2017 20:02:59 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblReligion
 * 
 * @property string $religion_id
 * @property string $religion_name
 * @property string $religion_name_en
 *
 * @package App\Models
 */
class TblReligion extends Eloquent
{
	protected $table = 'tbl_religion';
	protected $primaryKey = 'religion_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'religion_name',
		'religion_name_en'
	];
}
