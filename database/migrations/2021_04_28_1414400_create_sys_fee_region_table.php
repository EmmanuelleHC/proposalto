<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysFeeRegionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_fee_region', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('fee_group_id');
            $table->string('no_doc');
            $table->string('kodya_desc');
            $table->float('fee_ump');
            $table->float('fee_reg_store_kasir');
            $table->float('fee_reg_store_pramu');
            $table->float('fee_con_store_kasir');
            $table->float('fee_con_store_pramu');
            $table->float('fee_lembur');
            $table->string('file_path');
            $table->string('filename');
            $table->timestamps();
        });
        Schema::table('sys_fee_region', function($table) {
          $table->foreign('branch_id')->references('id')->on('sys_branch');
          $table->foreign('fee_group_id')->references('id')->on('sys_fee_group');


        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_fee_region');
    }
}
