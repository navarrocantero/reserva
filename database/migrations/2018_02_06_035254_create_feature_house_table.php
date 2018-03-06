<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureHouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_house', function (Blueprint $table) {
            $table->integer('house_id')->unsigned();
            $table->integer('feature_id')->unsigned();
            $table->primary(['house_id', 'feature_id']);

            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');
            $table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature_house');
    }
}
