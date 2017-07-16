<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 16 Jul 2017 15:05:21 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CurriculumSubMajor
 * 
 * @property int $curr_sub_major_id
 * @property int $curriculum_id
 * @property string $sub_major_id
 *
 * @package App\Models
 */
class CurriculumSubMajor extends Eloquent
{
	protected $table = 'curriculum_sub_major';
	protected $primaryKey = 'curr_sub_major_id';
	public $timestamps = false;

	protected $casts = [
		'curriculum_id' => 'int'
	];

	protected $fillable = [
		'curriculum_id',
		'sub_major_id'
	];
}
