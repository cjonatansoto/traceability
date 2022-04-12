<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchGuideItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch_guide_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dispatch_guide_id');
            $table->foreign('dispatch_guide_id')->references('id')->on('dispatch_guides');
            $table->unsignedBigInteger('quantity_type_id');
            $table->foreign('quantity_type_id')->references('id')->on('quantity_types');
            $table->bigInteger('amount');
            $table->bigInteger('pieces')->nullable();
            $table->double('kgs');
            $table->unsignedBigInteger('species_id');
            $table->unsignedBigInteger('cut_id');
            $table->unsignedBigInteger('preservation_id');
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
        Schema::dropIfExists('dispatch_guide_items');
    }
}
