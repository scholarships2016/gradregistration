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
class ApplicantNewsSource extends Eloquent
{
	protected $table = 'applicant_news_source';
	protected $primaryKey = 'app_news_id';
	public $timestamps = false;

    protected $casts = [
        'applicant_id' => 'int',
    ];

    protected $fillable = [
        'applicant_id',
        'news_source_id',
        'orther'
    ];
}
