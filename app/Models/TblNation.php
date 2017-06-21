<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 20 Jun 2017 23:10:20 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblNation
 * 
 * @property string $nation_id
 * @property string $nation_name
 * @property string $nation_name_en
 *
 * @package App\Models
 */
class TblNation extends Eloquent
{
	protected $table = 'tbl_nation';
	protected $primaryKey = 'nation_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'nation_name',
		'nation_name_en'
	];
        
 
}
