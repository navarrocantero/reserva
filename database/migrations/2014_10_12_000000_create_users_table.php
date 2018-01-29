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
            $table->engine = 'INNODB';
            $table->increments('id');
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('telephone')->unique()->nullable();
            $table->string('website')->nullable();
            $table->string('about')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('sex', [
                'male',
                'female',
                'other'
            ]);
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('password');
            $table->enum('status', [
                'active',
                'inactive',
                'other'
            ]);
            $table->rememberToken();
            $table->timestamps();
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
