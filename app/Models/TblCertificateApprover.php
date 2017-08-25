<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 24 Aug 2017 22:02:25 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblCertificateApprover
 * 
 * @property int $cert_appr_id
 * @property string $cert_appr_name
 * @property string $cert_appr_position
 * @property string $cert_appr_position_desc
 *
 * @package App\Models
 */
class TblCertificateApprover extends Eloquent
{
	protected $table = 'tbl_certificate_approver';
	protected $primaryKey = 'cert_appr_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cert_appr_id' => 'int'
	];

	protected $fillable = [
		'cert_appr_name',
		'cert_appr_position',
		'cert_appr_position_desc'
	];
}
