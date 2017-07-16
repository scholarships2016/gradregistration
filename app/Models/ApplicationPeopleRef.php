<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 16 Jul 2017 15:05:21 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ApplicationPeopleRef
 * 
 * @property int $app_people_id
 * @property int $application_id
 * @property string $app_people_name
 * @property string $app_people_phone
 * @property string $app_people_address
 * @property string $app_people_position
 *
 * @package App\Models
 */
class ApplicationPeopleRef extends Eloquent
{
	protected $table = 'application_people_ref';
	protected $primaryKey = 'app_people_id';
	public $timestamps = false;

	protected $casts = [
		'application_id' => 'int'
	];

	protected $fillable = [
		'application_id',
		'app_people_name',
		'app_people_phone',
		'app_people_address',
		'app_people_position'
	];
}
