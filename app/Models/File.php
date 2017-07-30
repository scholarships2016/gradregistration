<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
//
    const UPDATED_AT = 'modified';
    const CREATED_AT = 'created';

    protected $primaryKey = 'file_id';
    protected $table = 'file';
    protected $fillable = ['file_origi_name', 'file_gen_name', 'file_ext', 'file_path','file_mimetype', 'file_size', 'creator', 'modifier'];
}
