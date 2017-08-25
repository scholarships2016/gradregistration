<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblNewsSource
 * 
 * @property int $news_source_id
 * @property string $news_source_name
 * @property string $news_source_name_en
 *
 * @package App\Models
 */
class TblNewsSource extends Eloquent
{
	protected $table = 'tbl_news_source';
	protected $primaryKey = 'news_source_id';
	public $timestamps = false;

	protected $fillable = [
		'news_source_name',
		'news_source_name_en'
	];
}
