<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 23 Jul 2017 20:32:40 +0700.
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
 * @property string $creator
 * @property \Carbon\Carbon $created
 * @property string $modifier
 * @property \Carbon\Carbon $modified
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

	protected $dates = [
		'created',
		'modified'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'user_name',
		'password',
		'name',
		'last_login',
		'ipaddress',
		'creator',
		'created',
		'modifier',
		'modified'
	];
}
