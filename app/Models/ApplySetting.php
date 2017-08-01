<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ApplySetting
 * 
 * @property int $apply_setting_id
 * @property int $semester
 * @property string $academic_year
 * @property int $round_no
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $end_date
 * @property int $is_active
 * @property int $status
 * @property \Carbon\Carbon $created
 * @property string $creator
 * @property \Carbon\Carbon $modified
 * @property string $modifier
 *
 * @package App\Models
 */
class ApplySetting extends Eloquent {

    protected $table = 'apply_setting';
    protected $primaryKey = 'apply_setting_id';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public $timestamps = true;
    protected $casts = [
        'semester' => 'int',
        'round_no' => 'int',
        'is_active' => 'int',
        'status' => 'int'
    ];
    protected $dates = [
        'start_date',
        'end_date',
        'created',
        'modified'
    ];
    protected $fillable = [
        'semester',
        'academic_year',
        'round_no',
        'start_date',
        'end_date',
        'is_active',
        'status',
        'created',
        'creator',
        'modified',
        'modifier'
    ];

}
