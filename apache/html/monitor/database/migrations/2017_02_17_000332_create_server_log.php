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
        Schema::create('server_logs', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->dateTime('created_at');
            $table->double('load_average');
            $table->integer('mem_total');
            $table->integer('mem_free');
            $table->integer('buffers');
            $table->integer('cached');
            $table->integer('swap_total');
            $table->integer('swap_free');
            $table->String('uname');

            $table->integer('qtd_querys');
            $table->integer('qtd_sleeps');

            $table->integer('server_info_id')->unsigned();

            $table->foreign('server_info_id')->references('id')->on('server_infos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('server_logs');
    }
}
