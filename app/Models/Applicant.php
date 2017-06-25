<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 25 Jun 2017 19:06:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Applicant
 * 
 * @property int $applicant_id
 * @property string $stu_citizen_card
 * @property string $name_title_id
 * @property string $stu_first_name
 * @property string $stu_last_name
 * @property string $stu_first_name_en
 * @property string $stu_last_name_en
 * @property string $stu_sex
 * @property int $nation_id
 * @property string $stu_addr_no
 * @property string $stu_addr_village
 * @property string $stu_addr_soi
 * @property string $stu_addr_road
 * @property string $stu_addr_tumbon
 * @property int $stu_addr_dist
 * @property int $stu_addr_prov
 * @property string $stu_addr_pcode
 * @property string $stu_phone
 * @property string $stu_phone2
 * @property string $stu_email
 * @property string $eng_test_id
 * @property string $eng_test_score
 * @property string $thai_test_score
 * @property string $cu_best_score
 * @property string $stu_img
 * @property int $stu_birthdate
 * @property string $stu_religion
 * @property string $stu_married
 * @property string $stu_birthplace
 * @property string $additional_addr
 * @property int $eng_date_taken
 * @property string $convert
 * @property int $fund_interesting
 * @property string $eng_test_score_admin
 * @property string $modifire
 * @property string $eng_test_id_admin
 * @property string $stu_password
 * @property string $sys_activate_code
 * @property string $creator
 * @property \Carbon\Carbon $created
 * @property string $modifier
 * @property \Carbon\Carbon $modified
 *
 * @package App\Models
 */
class Applicant extends Eloquent
{
	protected $table = 'applicant';
	protected $primaryKey = 'applicant_id';
	public $timestamps = false;

	protected $casts = [
		'nation_id' => 'int',
		'stu_addr_dist' => 'int',
		'stu_addr_prov' => 'int',
		'stu_birthdate' => 'int',
		'eng_date_taken' => 'int',
		'fund_interesting' => 'int'
	];

	protected $dates = [
		'created',
		'modified'
	];

	protected $hidden = [
		'stu_password'
	];

	protected $fillable = [
		'stu_citizen_card',
		'name_title_id',
		'stu_first_name',
		'stu_last_name',
		'stu_first_name_en',
		'stu_last_name_en',
		'stu_sex',
		'nation_id',
		'stu_addr_no',
		'stu_addr_village',
		'stu_addr_soi',
		'stu_addr_road',
		'stu_addr_tumbon',
		'stu_addr_dist',
		'stu_addr_prov',
		'stu_addr_pcode',
		'stu_phone',
		'stu_phone2',
		'stu_email',
		'eng_test_id',
		'eng_test_score',
		'thai_test_score',
		'cu_best_score',
		'stu_img',
		'stu_birthdate',
		'stu_religion',
		'stu_married',
		'stu_birthplace',
		'additional_addr',
		'eng_date_taken',
		'convert',
		'fund_interesting',
		'eng_test_score_admin',
		'modifire',
		'eng_test_id_admin',
		'stu_password',
		'sys_activate_code',
		'creator',
		'created',
		'modifier',
		'modified'
	];
}
