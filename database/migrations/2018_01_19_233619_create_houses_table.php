<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->engine = 'INNODB';
            $table->increments('id');
            $table->timestamps();
            $table->string('location')->unique();
            $table->string('direction')->unique();
            $table->string('name');
            $table->string('slugname')->nullable();
            $table->double('price_user_night');
            $table->tinyInteger('rating')->nullable();
            $table->tinyInteger('max_users_house');
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
