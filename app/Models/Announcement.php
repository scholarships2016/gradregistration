<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 29 Jun 2017 14:04:55 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Announcement
 * 
 * @property int $anno_id
 * @property string $anno_title
 * @property string $anno_detail
 * @property string $anno_flag
 * @property string $creator
 * @property \Carbon\Carbon $created
 * @property string $modifier
 * @property \Carbon\Carbon $modified
 *
 * @package App\Models
 */
class Announcement extends Eloquent
{
	protected $table = 'announcement';
	protected $primaryKey = 'anno_id';
	public $timestamps = false;

	protected $dates = [
		'created',
		'modified'
	];

	protected $fillable = [
		'anno_title',
		'anno_detail',
		'anno_flag',
		'creator',
		'created',
		'modifier',
		'modified'
	];
}
