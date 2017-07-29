<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 29 Jul 2017 23:39:04 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ApplicationDocumentFile
 * 
 * @property int $application_file_id
 * @property int $application_id
 * @property int $doc_apply_id
 * @property int $file_id
 * @property string $other_val
 *
 * @package App\Models
 */
class ApplicationDocumentFile extends Eloquent
{
	protected $table = 'application_document_file';
	protected $primaryKey = 'application_file_id';
	public $timestamps = false;

	protected $casts = [
		'application_id' => 'int',
		'doc_apply_id' => 'int',
		'file_id' => 'int'
	];

	protected $fillable = [
		'application_id',
		'doc_apply_id',
		'file_id',
		'other_val'
	];
}
