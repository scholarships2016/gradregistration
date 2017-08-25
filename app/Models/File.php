<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class File
 * 
 * @property int $file_id
 * @property string $file_origi_name
 * @property string $file_gen_name
 * @property string $file_ext
 * @property string $file_mimetype
 * @property string $file_path
 * @property int $file_size
 * @property \Carbon\Carbon $created
 * @property \Carbon\Carbon $modified
 * @property string $creator
 * @property string $modifier
 *
 * @package App\Models
 */
class File extends Eloquent {

    protected $table = 'file';
    protected $primaryKey = 'file_id';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public $timestamps = true;
    protected $casts = [
        'file_size' => 'int'
    ];
    protected $dates = [
        'created',
        'modified'
    ];
    protected $fillable = [
        'file_origi_name',
        'file_gen_name',
        'file_ext',
        'file_mimetype',
        'file_path',
        'file_size',
        'created',
        'modified',
        'creator',
        'modifier'
    ];

}
