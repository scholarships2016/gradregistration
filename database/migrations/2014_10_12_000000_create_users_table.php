<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id')->nullable();
            $table->unsignedInteger('profile_id')->nullable();
            $table->string('egat_code_id')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('username')->unique();
            $table->boolean('is_ldap_auth')->default(false);
            $table->boolean('is_active')->default(false);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            $table->string('updated_by')->nullable();
            $table->string('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
