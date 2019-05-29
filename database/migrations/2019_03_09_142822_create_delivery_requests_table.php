<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('source_id')->unsigned();
            $table->foreign('source_id')->references('id')->on('departments');
            $table->bigInteger('destination_id')->unsigned();
            $table->foreign('destination_id')->references('id')->on('departments');
            $table->bigInteger('disc_id')->unsigned();
            $table->foreign('disc_id')->references('id')->on('discs');
            $table->boolean('accepted')->default(0);
            $table->string('comments')->default("");
            $table->softDeletes();
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
        Schema::dropIfExists('delivery_requests');
    }
}
