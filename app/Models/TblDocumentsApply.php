<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 13 Jul 2017 15:57:23 +0700.
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
 * @property string $doc_apply_detail_ne
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
		'active' => 'bool'
	];

	protected $fillable = [
		'doc_apply_group',
		'doc_apply_group_en',
		'doc_apply_detail',
		'doc_apply_detail_ne',
		'active'
	];
}
