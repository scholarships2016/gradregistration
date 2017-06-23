<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 24 Jun 2017 00:11:18 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblBank
 * 
 * @property int $id
 * @property string $bank_id
 * @property string $bank_account
 * @property string $bank_name
 * @property string $bank_fee
 * @property string $bank_logo
 *
 * @package App\Models
 */
class TblBank extends Eloquent
{
	protected $table = 'tbl_bank';
	public $timestamps = false;

	protected $fillable = [
		'bank_id',
		'bank_account',
		'bank_name',
		'bank_fee',
		'bank_logo'
	];
}
