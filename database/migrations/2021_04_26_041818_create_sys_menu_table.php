<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_menu', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name');
            $table->string('menu_desc');
            $table->unsignedBigInteger('role_id');
            $table->string('active_flag');
            $table->string('is_detail');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('sys_menu', function($table) {
            $table->foreign('role_id')->references('id')->on('sys_role');
            

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_menu');
    }
}
