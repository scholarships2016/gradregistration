<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
//    use Notifiable;
    use SoftDeletes;


    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'role_id', 'egat_code_id', 'username', 'is_ldap_auth', 'is_active', 'profile_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];


    public function role()
    {
//        return $this->belongsTo(Role::class, 'role_id', 'id');
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function moduleAuthorities()
    {
        return $this->hasMany(ModuleAuthority::class, 'user_id', 'id');
    }


    public function profile()
    {
        return $this->hasOne(Profile::class, 'id', 'profile_id');
    }


}
