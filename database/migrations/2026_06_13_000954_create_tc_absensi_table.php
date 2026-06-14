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
        if (Schema::hasTable('tc_absensi')) {
            return;
        }

        Schema::create('tc_absensi', function (Blueprint $table) {
            $table->increments('id_tc_absensi');
            $table->text('npp')->nullable();
            $table->integer('id_dd_absensi')->nullable();
            $table->integer('id_dd_jam_absen')->nullable();
            $table->dateTime('tgl_absensi')->nullable();
            $table->dateTime('jam_masuk')->nullable();
            $table->dateTime('jam_pulang')->nullable();
            $table->integer('id_dc_struktur_organisasi')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->integer('ko_wil')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('flag_um')->nullable();
            $table->integer('flag_lem')->nullable();
            $table->integer('id_check')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_absensi');
    }
};
