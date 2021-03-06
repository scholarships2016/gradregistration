<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblBank
 * 
 * @property int $bank_id
 * @property string $bank_code
 * @property string $bank_account
 * @property string $bank_name
 * @property string $bank_name_en
 * @property string $bank_fee
 * @property string $bank_logo
 *
 * @package App\Models
 */
class TblBank extends Eloquent
{
	protected $table = 'tbl_bank';
	protected $primaryKey = 'bank_id';
	public $timestamps = false;

	protected $fillable = [
		'bank_code',
		'bank_account',
		'bank_name',
		'bank_name_en',
		'bank_fee',
		'bank_logo'
	];
}
