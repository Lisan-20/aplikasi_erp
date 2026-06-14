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
        if (Schema::hasTable('fee_dr_sitting_temp')) {
            return;
        }

        Schema::create('fee_dr_sitting_temp', function (Blueprint $table) {
            $table->increments('id_fee_dr_sitting_temp');
            $table->integer('kode_dr')->nullable();
            $table->dateTime('tgl_praktek')->nullable();
            $table->string('nama_tindakan', 30)->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('kode_jadwal')->nullable();
            $table->integer('id_jadwal')->nullable();
            $table->integer('flag_sppu')->nullable();
            $table->integer('no_sppu')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('tahun')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_dr_sitting_temp');
    }
};
