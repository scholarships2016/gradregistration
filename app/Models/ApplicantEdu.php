<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 16 Jul 2017 15:05:21 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ApplicantEdu
 *
 * @property int $app_edu_id
 * @property int $applicant_id
 * @property string $grad_level
 * @property string $edu_pass_id
 * @property string $university_id
 * @property string $edu_year
 * @property string $edu_faculty
 * @property string $edu_major
 * @property string $edu_gpax
 * @property string $edu_degree
 * @property string $creator
 * @property \Carbon\Carbon $created
 * @property string $modifier
 * @property \Carbon\Carbon $modified
 *
 * @package App\Models
 */
class ApplicantEdu extends Eloquent
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $table = 'applicant_edu';
    protected $primaryKey = 'app_edu_id';
    public $timestamps = true;

    protected $casts = [
        'applicant_id' => 'int'
    ];

    protected $dates = [
        'created',
        'modified'
    ];

    protected $fillable = [
        'applicant_id',
        'grad_level',
        'edu_pass_id',
        'university_id',
        'edu_year',
        'edu_faculty',
        'edu_major',
        'edu_gpax',
        'edu_degree',
        'creator',
        'created',
        'modifier',
        'modified'
    ];
}
