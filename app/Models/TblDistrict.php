<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 29 Jun 2017 14:04:56 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblDistrict
 * 
 * @property int $district_code
 * @property string $province_id
 * @property string $district_id
 * @property string $district_name
 * @property string $district_name_en
 *
 * @package App\Models
 */
class TblDistrict extends Eloquent
{
	protected $table = 'tbl_district';
	protected $primaryKey = 'district_code';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'district_code' => 'int'
	];

	protected $fillable = [
		'province_id',
		'district_id',
		'district_name',
		'district_name_en'
	];
}
