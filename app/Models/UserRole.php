<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 24 Jun 2017 00:15:59 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserRole
 * 
 * @property int $user_id
 * @property int $role_id
 *
 * @package App\Models
 */
class UserRole extends Eloquent
{
	protected $table = 'user_role';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'role_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'role_id'
	];
}
