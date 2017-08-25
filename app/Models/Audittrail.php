<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Audittrail
 * 
 * @property int $audit_id
 * @property string $section
 * @property int $audit_action_id
 * @property string $detail
 * @property string $performer
 * @property \Carbon\Carbon $action_date
 *
 * @package App\Models
 */
class Audittrail extends Eloquent
{
	protected $table = 'audittrail';
	protected $primaryKey = 'audit_id';
	public $timestamps = false;

	protected $casts = [
		'audit_action_id' => 'int'
	];

	protected $dates = [
		'action_date'
	];

	protected $fillable = [
		'section',
		'audit_action_id',
		'detail',
		'performer',
		'action_date'
	];
}
