<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockLots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_lots', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lot_id');
            $table->bigInteger('dispatch_guide_id')->unsigned();
            $table->foreign('dispatch_guide_id')->references('id')->on('dispatch_guides');
            $table->bigInteger('quantity_type_id')->unsigned();
            $table->foreign('quantity_type_id')->references('id')->on('quantity_types');
            $table->bigInteger('measurement_unit_id')->unsigned();
            $table->foreign('measurement_unit_id')->references('id')->on('measurement_units');
            $table->bigInteger('items');
            $table->double('amount');
            $table->double('kg_amount');
            $table->bigInteger('loaded_by')->unsigned();
            $table->foreign('loaded_by')->references('id')->on('users');
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
        Schema::dropIfExists('stock_lots');
    }
}
