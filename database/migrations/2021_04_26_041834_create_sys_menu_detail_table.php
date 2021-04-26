<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysMenuDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_menu_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->integer('seq');
            $table->string('prompt');
            $table->string('description');
            $table->string('active_flag');
            $table->timestamps();
        });
        Schema::table('sys_menu_detail', function($table) {
          $table->foreign('menu_id')->references('id')->on('sys_menu');

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::dropIfExists('sys_menu_detail');
    }
}
