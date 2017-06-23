<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 23 Jun 2017 16:49:15 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblUser
 * 
 * @property int $user_id
 * @property string $user_name
 * @property string $password
 * @property string $name
 * @property int $last_login
 * @property string $ipaddress
 *
 * @package App\Models
 */
class TblUser extends Eloquent
{
	protected $table = 'tbl_user';
	protected $primaryKey = 'user_id';
	public $timestamps = false;

	protected $casts = [
		'last_login' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'user_name',
		'password',
		'name',
		'last_login',
		'ipaddress'
	];
}
