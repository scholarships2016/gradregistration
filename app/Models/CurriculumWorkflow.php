<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CurriculumWorkflow
 * 
 * @property int $workflow_id
 * @property int $curriculum_id
 * @property \Carbon\Carbon $workflow_start_datetime
 * @property string $workflow_start_by
 * @property \Carbon\Carbon $workflow_finish_datetime
 * @property string $workflow_finish_by
 *
 * @package App\Models
 */
class CurriculumWorkflow extends Eloquent
{
	protected $table = 'curriculum_workflow';
	protected $primaryKey = 'workflow_id';
	public $timestamps = false;

	protected $casts = [
		'curriculum_id' => 'int'
	];

	protected $dates = [
		'workflow_start_datetime',
		'workflow_finish_datetime'
	];

	protected $fillable = [
		'curriculum_id',
		'workflow_start_datetime',
		'workflow_start_by',
		'workflow_finish_datetime',
		'workflow_finish_by'
	];
}
