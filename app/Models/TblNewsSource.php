<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 25 Jun 2017 13:09:02 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblNewsSource
 * 
 * @property int $id
 * @property string $news_source_name
 * @property string $news_source_name_en
 *
 * @package App\Models
 */
class TblNewsSource extends Eloquent
{
	protected $table = 'tbl_news_source';
	public $timestamps = false;

	protected $fillable = [
		'news_source_name',
		'news_source_name_en'
	];
}
