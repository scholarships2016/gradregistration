<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 23 Jul 2017 20:32:39 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblFlowApply
 * 
 * @property int $flow_id
 * @property string $flow_name
 * @property string $flow_name_en
 *
 * @package App\Models
 */
class TblFlowApply extends Eloquent
{
	protected $table = 'tbl_flow_apply';
	protected $primaryKey = 'flow_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'flow_id' => 'int'
	];

	protected $fillable = [
		'flow_name',
		'flow_name_en'
	];
}
