<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
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
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'application_file_id' => 'int',
        'application_id' => 'int',
        'doc_apply_id' => 'int',
        'file_id' => 'int'
    ];

    protected $fillable = [
        'application_file_id',
        'application_id',
        'doc_apply_id',
        'file_id',
        'other_val'
    ];

    public function docFile()
    {
        return $this->hasOne(File::class, 'file_id', 'file_id');
    }
}
