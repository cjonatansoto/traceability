<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralBackground extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_background', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dispatch_guide_id');
            $table->foreign('dispatch_guide_id')->references('id')->on('dispatch_guides');
            $table->bigInteger('place_id')->unsigned();
            $table->foreign('place_id')->references('id')->on('places');
            $table->string('cage');
            $table->string('warranty_statement');
            $table->date('harvest_date');
            $table->string('file');
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->unsigned();
            $table->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('general_background');
    }
}
