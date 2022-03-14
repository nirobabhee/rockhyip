<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**            1=>yew ,2=>
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->double('minimum_investment',28,8)->default(0);
            $table->double('maximum_investment',28,8)->default(0);
            $table->tinyInteger('interest_status')->default(0);
            $table->double('interest',28,8)->default(0);
            $table->integer('times')->default(0);
            $table->tinyInteger('capital_back')->default(0);
            $table->integer('repeat_time')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('plans');
    }
}
