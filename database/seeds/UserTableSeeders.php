<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeders extends Seeder {

    public function run() {
        DB::table('users')->delete();
        User::create(array(
            'role_id' => '0',
            'profile_id' => '000',
            'username' => 'sevilayha',
            'email' => 'chris@scotch.io',
            'password' => Hash::make('awesome'),
        ));
    }

}
