<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_branch', function (Blueprint $table) {
            $table->id();
            $table->string('branch_code');
            $table->string('branch_name');
            $table->string('branch_type');
            $table->string('region');
            $table->string('alt_name');
            $table->string('active_flag');
            $table->float('minus_gm_frc');
            $table->float('batas_spd');
            $table->float('batas_gm');
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
        Schema::dropIfExists('sys_branch');
    }
}
