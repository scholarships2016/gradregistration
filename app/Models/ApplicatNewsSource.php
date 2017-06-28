<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 29 Jun 2017 00:41:55 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ApplicatNewsSource
 * 
 * @property int $app_news_id
 * @property int $applicant_id
 * @property int $news_source_id
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
		'news_source_id' => 'int'
	];

	protected $fillable = [
		'applicant_id',
		'news_source_id',
		'orther'
	];
}
