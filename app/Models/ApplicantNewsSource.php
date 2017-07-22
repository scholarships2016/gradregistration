<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 22 Jul 2017 22:38:49 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ApplicantNewsSource
 * 
 * @property int $app_news_id
 * @property int $applicant_id
 * @property int $news_source_id
 * @property string $orther
 *
 * @package App\Models
 */
class ApplicantNewsSource extends Eloquent
{
	protected $table = 'applicant_news_source';
	protected $primaryKey = 'app_news_id';
	public $timestamps = false;

	protected $casts = [
		'applicant_id' => 'int',
		'news_source_id' => 'int'
	];

	protected $fillable = [
		'applicant_id',
		'news_source_id',
		'orther'
	];
}
