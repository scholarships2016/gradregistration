<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CurriculumWorkflowTransaction
 *
 * @property int $curr_wf_tran_id
 * @property int $workflow_id
 * @property string $comment
 * @property int $workflow_status_id
 * @property \Carbon\Carbon $created
 * @property string $creator
 *
 * @package App\Models
 */
class CurriculumWorkflowTransaction extends Eloquent
{

    protected $table = 'curriculum_workflow_transaction';
    protected $primaryKey = 'curr_wf_tran_id';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public $timestamps = true;
    protected $casts = [
        'workflow_status_id' => 'int'
    ];
    protected $dates = [
        'created'
    ];
    protected $fillable = [
        'comment',
        'workflow_status_id',
        'curriculum_id',
        'created',
        'creator'
    ];

}
