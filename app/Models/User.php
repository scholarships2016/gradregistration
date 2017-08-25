<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 01 Aug 2017 10:44:36 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 *
 * @property int $user_id
 * @property string $user_name
 * @property string $user_password
 * @property string $name
 * @property int $role_id
 * @property int $last_login
 * @property string $ipaddress
 * @property string $remember_token
 * @property string $creator
 * @property \Carbon\Carbon $created
 * @property string $modifier
 * @property \Carbon\Carbon $modified
 *
 * @package App\Models
 */
class User extends Eloquent
{

    protected $table = 'user';
    protected $primaryKey = 'user_id';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public $timestamps = true;
    protected $casts = [
        'role_id' => 'int',
        'last_login' => 'int'
    ];
    protected $dates = [
        'created',
        'modified'
    ];
    protected $hidden = [
        'user_password',
        'remember_token'
    ];
    protected $fillable = [
        'user_name',
        'user_password',
        'user_email',
        'name',
        'nickname',
        'role_id',
        'last_login',
        'ipaddress',
        'remember_token',
        'creator',
        'created',
        'modifier',
        'modified'
    ];

    public function userPermission()
    {
        return $this->hasMany(UserPermission::class, 'user_id', 'user_id');
    }

}
