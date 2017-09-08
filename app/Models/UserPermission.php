<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserPermission
 *
 * @property int $user_id
 * @property int $permission_id
 *
 * @package App\Models
 */
class UserPermission extends Eloquent
{
    protected $table = 'user_permission';
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'user_id' => 'int',
        'permission_id' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'permission_id'
    ];

    public function permission()
    {
        return $this->hasMany(TblPermission::class, 'permission_id', 'permission_id');
    }
}
