<?php

namespace App;

use App\Models\TblRole;
use App\Models\UserPermission;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_name',
        'user_password',
        'name',
        'last_login',
        'ipaddress',
        'creator',
        'created',
        'modifier',
        'remember_token',
        'role_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'user_password'
    ];

    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function role()
    {
        return $this->hasOne(TblRole::class, 'role_id', 'role_id');
    }

    public function userPermission()
    {
        return $this->hasMany(UserPermission::class, 'user_id', 'user_id');
    }


}
