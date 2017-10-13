<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

class ApplicantSpecialApply extends Eloquent
{

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modifier';

    protected $table = 'applicant_special_apply';
    public $incrementing = false;
    public $timestamps = true;
    protected $primaryKey = 'appt_spec_appl_id';

    protected $fillable = [
        'creator',
        'modifier',
        'applicant_id',
        'start_date',
        'end_date',
        'curriculum_id'
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'applicant_id' => 'int',
        'curriculum_id' => 'int'
    ];

}
