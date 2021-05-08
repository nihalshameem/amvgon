<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryPaidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_paids', function (Blueprint $table) {
            $table->id();
            $table->string('delivery_id');
            $table->string('order_count');
            $table->string('delivery_charge');
            $table->string('weekly_incentive');
            $table->string('order_incentive');
            $table->string('total_amount');
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
        Schema::dropIfExists('salary_paids');
    }
}
