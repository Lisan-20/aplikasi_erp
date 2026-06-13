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
        if (Schema::hasTable('tc_cuti_dokter')) {
            return;
        }

        Schema::create('tc_cuti_dokter', function (Blueprint $table) {
            $table->increments('id_cuti_dokter');
            $table->dateTime('tgl_mulai_cuti')->nullable();
            $table->dateTime('tgl_akhir_cuti')->nullable();
            $table->string('range_hari', 20)->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('keterangan', 50)->nullable();
            $table->integer('id_mt_jadwal_dokter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_cuti_dokter');
    }
};
