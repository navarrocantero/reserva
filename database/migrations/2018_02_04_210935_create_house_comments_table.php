<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_comments', function (Blueprint $table) {
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('house_id')->unsigned();
            $table->text('content');

            $table->primary(['house_id', 'user_id']);

            $table->foreign('house_id')->references('id')->on('houses');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_comments');
    }
}
