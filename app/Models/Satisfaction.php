<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 29 Jul 2017 23:39:04 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Satisfaction
 * 
 * @property int $SATI_NO
 * @property string $stu_citizen_card
 * @property string $SATI_LEVEL
 * @property string $SATI_SUGGESTION
 * @property int $CREATED
 * @property string $CREATOR
 * @property int $MODIFIED
 * @property string $MODIFIER
 *
 * @package App\Models
 */
class Satisfaction extends Eloquent
{
	protected $table = 'satisfaction';
	protected $primaryKey = 'SATI_NO';
	public $timestamps = false;

	protected $casts = [
		'CREATED' => 'int',
		'MODIFIED' => 'int'
	];

	protected $fillable = [
		'stu_citizen_card',
		'SATI_LEVEL',
		'SATI_SUGGESTION',
		'CREATED',
		'CREATOR',
		'MODIFIED',
		'MODIFIER'
	];
}
