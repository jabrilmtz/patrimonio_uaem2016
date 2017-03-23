<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->nullable();
            $table->string('comment');
            $table->integer('status')->default(0);
            $table->integer('incidence_type_id')->unsigned();
            $table->integer('asset_id')->unsigned();
            $table->timestamps();

            $table->foreign('incidence_type_id')->references('id')->on('incidences_types');
            $table->foreign('asset_id')->references('id')->on('assets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidences');
    }
}
