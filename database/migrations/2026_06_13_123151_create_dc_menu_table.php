<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dc_menu', function (Blueprint $table) {
            $table->increments('id_dc_menu');
            $table->integer('id_dc_modul')->nullable();
            $table->string('nama_menu', 50)->nullable();
            $table->string('url', 50)->nullable();
            $table->integer('no_urut')->nullable();
            $table->tinyInteger('status_menu')->nullable()->default(0);
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->integer('flag_not')->nullable();

            $table->primary(['id_dc_menu'], 'pk_dc_menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_menu');
    }
};
