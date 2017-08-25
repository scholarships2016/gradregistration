<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblAudittrailAction
 * 
 * @property int $audit_action_id
 * @property string $audit_action_name
 * @property \Carbon\Carbon $created
 * @property string $creator
 * @property \Carbon\Carbon $modified
 * @property string $modifier
 *
 * @package App\Models
 */
class TblAudittrailAction extends Eloquent {

    protected $table = 'tbl_audittrail_action';
    protected $primaryKey = 'audit_action_id';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public $timestamps = true;
    protected $dates = [
        'created',
        'modified'
    ];
    protected $fillable = [
        'audit_action_name',
        'created',
        'creator',
        'modified',
        'modifier'
    ];

}
