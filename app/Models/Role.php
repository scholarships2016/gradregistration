<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $table = 'roles';

    protected $fillable = ['role_name_th', 'role_name_eng', 'role_desc', 'is_active','role_actions'];

    protected $dates = ['deleted_at'];


//    public function users()
//    {
//        return $this->hasMany(User::class);
//    }
}
