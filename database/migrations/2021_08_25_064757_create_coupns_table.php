<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoupnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupns', function (Blueprint $table) {
            $table->id();
            $table->string('coupn_code');
            $table->string('valid_date');
            $table->string('coupn_status');
            $table->float('coupn_amount',10,2);
            $table->integer('coupn_type');
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
        Schema::dropIfExists('coupns');
    }
}
