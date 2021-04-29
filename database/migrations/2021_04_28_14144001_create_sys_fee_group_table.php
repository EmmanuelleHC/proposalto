<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysFeeGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_fee_group', function (Blueprint $table) {
            $table->id();
            $table->string('fee_group_code');
            $table->string('fee_code_description');
            $table->string('active_flag');
            $table->float('fee_non_24');
            $table->float('fee_24');
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
        Schema::dropIfExists('sys_fee_group');
    }
}
