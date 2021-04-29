<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysPeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_period', function (Blueprint $table) {
            $table->id();
            $table->string('periode');
            $table->unsignedBigInteger('branch_id');
            $table->string('status');
            $table->timestamps();
        });
         Schema::table('sys_period', function($table) {
            $table->foreign('branch_id')->references('id')->on('sys_branch');
            

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_period');
    }
}
