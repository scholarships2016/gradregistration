<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblAdmissionStatus
 * 
 * @property string $admission_status_id
 * @property string $admission_status_name_th
 * @property string $admission_status_name_en
 *
 * @package App\Models
 */
class TblExamStatus extends Eloquent
{
	protected $table = 'tbl_exam_status';
	protected $primaryKey = 'exam_id';
	public $incrementing = true;
	public $timestamps = false;

	protected $fillable = [
		'exam_name',
		'exam_name_en'
	];
}
