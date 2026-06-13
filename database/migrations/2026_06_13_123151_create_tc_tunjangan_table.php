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
        if (Schema::hasTable('tc_tunjangan')) {
            return;
        }

        Schema::create('tc_tunjangan', function (Blueprint $table) {
            $table->increments('id_tc_tunjangan');
            $table->string('npp', 6)->nullable();
            $table->string('nama_pegawai', 50)->nullable();
            $table->integer('id_dd_kelompok')->nullable();
            $table->string('kelompok', 50)->nullable();
            $table->integer('id_dd_ket_tunjangan')->nullable();
            $table->string('ket_tunjangan', 50)->nullable();
            $table->tinyInteger('id_bln_awal')->nullable();
            $table->string('bln_awal', 50)->nullable();
            $table->tinyInteger('id_bln_akhir')->nullable();
            $table->string('bln_akhir', 50)->nullable();
            $table->tinyInteger('periode')->nullable();
            $table->integer('tahun')->nullable();
            $table->tinyInteger('jenis_tunj_kel')->nullable();
            $table->string('ket_jenis_tunj_kel', 50)->nullable();
            $table->decimal('nilai_tunj_kel', 19, 4)->nullable()->default(0);
            $table->integer('prosen_tunj_kel')->nullable()->default(0);
            $table->decimal('jumlah_tunj_kel', 19, 4)->nullable()->default(0);
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->integer('id_mt_periode_gaji')->nullable();
            $table->integer('absen')->nullable();
            $table->integer('terlambat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_tunjangan');
    }
};
