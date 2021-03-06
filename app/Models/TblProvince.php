<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblProvince
 * 
 * @property int $province_id
 * @property int $province_code
 * @property string $province_name
 * @property string $province_name_en
 *
 * @package App\Models
 */
class TblProvince extends Eloquent
{
	protected $table = 'tbl_province';
	protected $primaryKey = 'province_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'province_id' => 'int',
		'province_code' => 'int'
	];

	protected $fillable = [
		'province_code',
		'province_name',
		'province_name_en'
	];
}
