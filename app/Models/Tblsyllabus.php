<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 13 Jul 2017 15:57:23 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Tblsyllabus
 * 
 * @property int $ID
 * @property string $syllabus_id
 * @property string $cond_id
 *
 * @package App\Models
 */
class Tblsyllabus extends Eloquent
{
	protected $table = 'tblsyllabus';
	protected $primaryKey = 'ID';
	public $timestamps = false;

	protected $fillable = [
		'syllabus_id',
		'cond_id'
	];
}
