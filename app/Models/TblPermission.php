<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblPermission
 * 
 * @property int $permission_id
 * @property string $permission_name
 * @property string $permission_name_en
 * @property string $permission_description
 *
 * @package App\Models
 */
class TblPermission extends Eloquent
{
	protected $table = 'tbl_permission';
	protected $primaryKey = 'permission_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'permission_id' => 'int'
	];

	protected $fillable = [
		'permission_name',
		'permission_name_en',
		'permission_description'
	];
}
