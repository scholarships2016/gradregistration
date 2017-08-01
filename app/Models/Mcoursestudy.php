<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Mcoursestudy
 * 
 * @property string $programsystem
 * @property string $studyprogramsystem
 * @property string $calendar
 * @property string $coursecodeno
 * @property string $degree
 * @property string $depcode
 * @property string $majorcode
 * @property string $noyear
 * @property string $minperiod
 * @property string $maxperiod
 * @property string $credittot
 * @property string $plan
 * @property string $language
 * @property string $beginacadyear
 * @property string $beginsemester
 * @property string $lastacadyear
 * @property string $lastsemester
 * @property string $stopacadyear
 * @property string $stopsemester
 * @property string $thai
 * @property string $english
 * @property string $degreethai
 * @property string $degreeenglish
 * @property string $status
 * @property string $usercode
 * @property string $updatedate
 * @property string $changestame
 *
 * @package App\Models
 */
class Mcoursestudy extends Eloquent
{
	protected $table = 'mcoursestudy';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'programsystem',
		'studyprogramsystem',
		'calendar',
		'coursecodeno',
		'degree',
		'depcode',
		'majorcode',
		'noyear',
		'minperiod',
		'maxperiod',
		'credittot',
		'plan',
		'language',
		'beginacadyear',
		'beginsemester',
		'lastacadyear',
		'lastsemester',
		'stopacadyear',
		'stopsemester',
		'thai',
		'english',
		'degreethai',
		'degreeenglish',
		'status',
		'usercode',
		'updatedate',
		'changestame'
	];
}
