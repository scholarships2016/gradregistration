<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 25 Jun 2017 18:28:05 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblProvince
 * 
 * @property int $province_code
 * @property string $province_id
 * @property string $province_name
 *
 * @package App\Models
 */
class TblProvince extends Eloquent
{
	protected $table = 'tbl_province';
	protected $primaryKey = 'province_code';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'province_code' => 'int'
	];

	protected $fillable = [
		'province_id',
		'province_name'
	];
}
