<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysRespTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_resp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->string('resp_name');
            $table->string('resp_desc');
            $table->string('active_flag');
            $table->integer('branch_id');
            $table->timestamps();
        });
        Schema::table('sys_resp', function($table) {
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
        Schema::dropIfExists('sys_resp');
    }
}
