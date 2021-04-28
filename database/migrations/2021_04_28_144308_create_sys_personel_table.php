<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysPersonelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_personel', function (Blueprint $table) {
            $table->id();
            $table->string('no_doc');
            $table->string('store_type');
            $table->string('file_path');
            $table->string('filename');
            $table->float('min_spd');
            $table->float('max_spd');
            $table->integer('total_personel');
            $table->float('total_pramu');
            $table->float('total_kasir');
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
        Schema::dropIfExists('sys_personel');
    }
}
