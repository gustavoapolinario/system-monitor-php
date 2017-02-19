<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_log', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->dateTime('created_at');
            $table->string('load_average');
            $table->string('mem_info');
            $table->string('qtd_querys');
            $table->string('qtd_sleeps');
            $table->integer('server_info_id')->unsigned();

            $table->foreign('server_info_id')->references('id')->on('server_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('server_log');
    }
}
