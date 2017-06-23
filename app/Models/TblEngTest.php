<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 24 Jun 2017 00:11:18 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblEngTest
 * 
 * @property string $eng_test_id
 * @property string $eng_test_name
 *
 * @package App\Models
 */
class TblEngTest extends Eloquent
{
	protected $table = 'tbl_eng_test';
	protected $primaryKey = 'eng_test_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'eng_test_name'
	];
}
