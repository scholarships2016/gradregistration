<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblDepartment
 *
 * @property string $department_id
 * @property string $department_name
 * @property string $department_name_en
 * @property string $faculty_id
 *
 * @package App\Models
 */
class TblDepartment extends Eloquent
{
    protected $table = 'tbl_department';
    protected $primaryKey = 'department_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'department_name',
        'department_name_en',
        'faculty_id'
    ];

    public function faculty()
    {
        return $this->hasOne(TblFaculty::class, 'faculty_id', 'faculty_id');
    }
}
