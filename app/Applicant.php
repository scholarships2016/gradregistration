<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Applicant extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'applicant';
    protected $primaryKey = 'applicant_id';
    protected $fillable = [
       'stu_first_name','stu_last_name','stu_password','stu_email','remember_token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'stu_password' 
    ];
    public function getAuthPassword () {

    return $this->stu_password;

}
}