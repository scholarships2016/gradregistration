<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable {

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
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
       'user_password'
    ];

    public function getAuthPassword() {
        return $this->user_password;
    }

}
