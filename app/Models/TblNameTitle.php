<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 25 Jun 2017 19:06:37 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblNameTitle
 * 
 * @property string $name_title_id
 * @property string $name_title_thai
 * @property string $name_title_eng
 *
 * @package App\Models
 */
class TblNameTitle extends Eloquent
{
	protected $table = 'tbl_name_title';
	protected $primaryKey = 'name_title_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'name_title_thai',
		'name_title_eng'
	];
}
