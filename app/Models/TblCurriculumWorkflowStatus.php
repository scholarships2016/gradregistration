<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblCurriculumWorkflowStatus
 * 
 * @property int $curr_wf_status_id
 * @property string $status_name
 * @property string $status_description
 * @property \Carbon\Carbon $created
 * @property string $creator
 * @property \Carbon\Carbon $modified
 * @property string $modifirer
 *
 * @package App\Models
 */
class TblCurriculumWorkflowStatus extends Eloquent {

    protected $table = 'tbl_curriculum_workflow_status';
    protected $primaryKey = 'curr_wf_status_id';
    public $incrementing = false;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public $timestamps = true;
    protected $casts = [
        'curr_wf_status_id' => 'int'
    ];
    protected $dates = [
        'created',
        'modified'
    ];
    protected $fillable = [
        'status_name',
        'status_description',
        'created',
        'creator',
        'modified',
        'modifirer'
    ];

}
