<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 29 Jun 2017 00:41:55 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblReligion
 * 
 * @property int $religion_id
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

	protected $casts = [
		'religion_id' => 'int'
	];

	protected $fillable = [
		'religion_name',
		'religion_name_en'
	];
}
