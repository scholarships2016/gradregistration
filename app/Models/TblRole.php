<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 25 Jun 2017 13:09:02 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblRole
 * 
 * @property int $role_id
 * @property string $role_name
 * @property string $role_description
 *
 * @package App\Models
 */
class TblRole extends Eloquent
{
	protected $table = 'tbl_role';
	protected $primaryKey = 'role_id';
	public $timestamps = false;

	protected $fillable = [
		'role_name',
		'role_description'
	];
}
