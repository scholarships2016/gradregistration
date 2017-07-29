<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 29 Jul 2017 23:39:04 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserSpecialProgram
 * 
 * @property int $user_special_id
 * @property int $user_id
 * @property int $doc_id
 * @property int $doc_type
 *
 * @package App\Models
 */
class UserSpecialProgram extends Eloquent
{
	protected $table = 'user_special_program';
	protected $primaryKey = 'user_special_id';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'doc_id' => 'int',
		'doc_type' => 'int'
	];

	protected $fillable = [
		'user_id',
		'doc_id',
		'doc_type'
	];
}
