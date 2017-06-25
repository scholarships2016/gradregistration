<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 25 Jun 2017 19:06:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ApplicatNewsSource
 * 
 * @property int $app_news_id
 * @property int $applicant_id
 * @property int $id
 * @property string $orther
 *
 * @package App\Models
 */
class ApplicatNewsSource extends Eloquent
{
	protected $table = 'applicat_news_source';
	protected $primaryKey = 'app_news_id';
	public $timestamps = false;

	protected $casts = [
		'applicant_id' => 'int',
		'id' => 'int'
	];

	protected $fillable = [
		'applicant_id',
		'id',
		'orther'
	];
}
