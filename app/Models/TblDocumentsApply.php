<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 22 Jul 2017 14:18:46 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblDocumentsApply
 * 
 * @property int $doc_apply_id
 * @property string $doc_apply_group
 * @property string $doc_apply_group_en
 * @property string $doc_apply_detail
 * @property string $doc_apply_detail_en
 * @property bool $flag_upload
 * @property bool $active
 *
 * @package App\Models
 */
class TblDocumentsApply extends Eloquent
{
	protected $table = 'tbl_documents_apply';
	protected $primaryKey = 'doc_apply_id';
	public $timestamps = false;

	protected $casts = [
		'flag_upload' => 'bool',
		'active' => 'bool'
	];

	protected $fillable = [
		'doc_apply_group',
		'doc_apply_group_en',
		'doc_apply_detail',
		'doc_apply_detail_en',
		'flag_upload',
		'active'
	];
}
