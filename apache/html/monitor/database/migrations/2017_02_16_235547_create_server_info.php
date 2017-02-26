<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_infos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('host');
            $table->string('port')->nullable();
            $table->string('database')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('charset')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('last_sync_log')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('server_infos');
    }
}
