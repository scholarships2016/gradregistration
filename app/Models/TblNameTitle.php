<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 23 Jul 2017 20:32:39 +0700.
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
