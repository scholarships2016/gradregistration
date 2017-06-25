<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 25 Jun 2017 13:09:02 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblGaduateLevel
 * 
 * @property int $grad_level_id
 * @property string $grad_level_abbr
 * @property string $grad_level_name
 * @property string $remark
 *
 * @package App\Models
 */
class TblGaduateLevel extends Eloquent
{
	protected $table = 'tbl_gaduate_level';
	protected $primaryKey = 'grad_level_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'grad_level_id' => 'int'
	];

	protected $fillable = [
		'grad_level_abbr',
		'grad_level_name',
		'remark'
	];
}
