<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 22 Jul 2017 22:38:49 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblNation
 * 
 * @property int $nation_id
 * @property string $nation_name
 * @property string $nation_name_en
 *
 * @package App\Models
 */
class TblNation extends Eloquent
{
	protected $table = 'tbl_nation';
	protected $primaryKey = 'nation_id';
	public $timestamps = false;

	protected $fillable = [
		'nation_name',
		'nation_name_en'
	];
}
