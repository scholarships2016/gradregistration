<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 22 Jul 2017 14:18:46 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblNameTitle
 * 
 * @property int $name_title_id
 * @property string $name_title
 * @property string $name_title_en
 *
 * @package App\Models
 */
class TblNameTitle extends Eloquent
{
	protected $table = 'tbl_name_title';
	protected $primaryKey = 'name_title_id';
	public $timestamps = false;

	protected $fillable = [
		'name_title',
		'name_title_en'
	];
}
