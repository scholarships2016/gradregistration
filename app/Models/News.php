<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 24 Aug 2017 22:01:17 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class News
 * 
 * @property int $news_id
 * @property string $news_title
 * @property string $news_detail
 * @property string $news_title_en
 * @property string $news_detail_en
 * @property int $news_seq
 * @property int $news_is_active
 * @property string $creator
 * @property \Carbon\Carbon $created
 * @property string $modifier
 * @property \Carbon\Carbon $modified
 *
 * @package App\Models
 */
class News extends Eloquent
{
	protected $primaryKey = 'news_id';
	public $timestamps = false;

	protected $casts = [
		'news_seq' => 'int',
		'news_is_active' => 'int'
	];

	protected $dates = [
		'created',
		'modified'
	];

	protected $fillable = [
		'news_title',
		'news_detail',
		'news_title_en',
		'news_detail_en',
		'news_seq',
		'news_is_active',
		'creator',
		'created',
		'modifier',
		'modified'
	];
}
