<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();
        $this->call('UserTableSeeder');
    }

}


class UserTableSeeder extends Seeder {

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
