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
        if (Schema::hasTable('dc_modul')) {
            return;
        }

        Schema::create('dc_modul', function (Blueprint $table) {
            $table->increments('id_dc_modul');
            $table->string('nama_modul', 50)->nullable();
            $table->string('logo', 50)->nullable();
            $table->integer('id_dc_modular')->nullable();
            $table->integer('no_urut')->nullable();
            $table->tinyInteger('status_modul')->nullable()->default(0);
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('folder', 50)->nullable();

            $table->primary(['id_dc_modul'], 'pk_dc_modul');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_modul');
    }
};
