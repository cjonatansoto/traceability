<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchGuides extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch_guides', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('number');
            $table->dateTime('plant_entry_date');
            $table->dateTime('date_physical_guide');
            $table->dateTime('target_date');
            $table->unsignedBigInteger('enterprise_id');
            $table->unsignedBigInteger('provider_id');
            $table->bigInteger('dispatch_guide_type_id')->unsigned();
            $table->foreign('dispatch_guide_type_id')->references('id')->on('dispatch_guide_types');
            $table->string('observations')->nullable();
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
        Schema::dropIfExists('dispatch_guides');
    }
}
