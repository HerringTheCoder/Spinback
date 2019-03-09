<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('source_id')->unsigned();
            $table->foreign('source_id')->references('id')->on('departments');
            $table->bigInteger('target_id')->unsigned();
            $table->foreign('target_id')->references('id')->on('departments');
            $table->bigInteger('disc_id')->unsigned();
            $table->foreign('disc_id')->references('id')->on('discs');
            $table->boolean('accepted')->default(0);
            $table->string('comments')->default("");
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
        Schema::dropIfExists('shipping_requests');
    }
}
