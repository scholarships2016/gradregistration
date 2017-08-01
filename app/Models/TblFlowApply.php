<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
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
	public $timestamps = false;

	protected $fillable = [
		'flow_name',
		'flow_name_en'
	];
}
