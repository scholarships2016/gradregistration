<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 20 Jun 2017 23:10:20 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblTypeOfRecruit
 * 
 * @property int $type_of_recruit_id
 * @property string $type_of_recruit
 * @property string $cond_id
 * @property string $degree
 * @property string $office_time
 *
 * @package App\Models
 */
class TblTypeOfRecruit extends Eloquent
{
	protected $table = 'tbl_type_of_recruit';
	protected $primaryKey = 'type_of_recruit_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'type_of_recruit_id' => 'int'
	];

	protected $fillable = [
		'type_of_recruit',
		'cond_id',
		'degree',
		'office_time'
	];
}
