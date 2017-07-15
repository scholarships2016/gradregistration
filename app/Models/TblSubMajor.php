<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 13 Jul 2017 15:57:23 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblSubMajor
 * 
 * @property string $sub_major_id
 * @property string $sub_major_name
 * @property string $sub_major_name_en
 * @property int $major_id
 *
 * @package App\Models
 */
class TblSubMajor extends Eloquent
{
	protected $table = 'tbl_sub_major';
	protected $primaryKey = 'sub_major_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'major_id' => 'int'
	];

	protected $fillable = [
		'sub_major_name',
		'sub_major_name_en',
		'major_id'
	];
}
