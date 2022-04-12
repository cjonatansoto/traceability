<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysisResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dispatch_guide_id');
            $table->foreign('dispatch_guide_id')->references('id')->on('dispatch_guides');
            $table->bigInteger('number');
            $table->bigInteger('laboratory_id')->unsigned();
            $table->foreign('laboratory_id')->references('id')->on('laboratories');
            $table->date('report_date');
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
        Schema::dropIfExists('analysis_results');
    }
}
