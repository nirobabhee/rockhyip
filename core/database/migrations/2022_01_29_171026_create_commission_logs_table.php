<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('from_id')->unsigned()->default(0);
            $table->integer('to_id')->unsigned()->default(0);
            $table->integer('level')->default(0);
            $table->double('percent', 28, 8)->default(0);
            $table->double('amount', 28, 8)->default(0);
            $table->string('trx', 40)->nullable();
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
        Schema::dropIfExists('commission_logs');
    }
}
