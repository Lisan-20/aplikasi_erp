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
        Schema::create('pl_tc_poli_2023', function (Blueprint $table) {
            $table->integer('id_pl_tc_poli')->nullable();
            $table->integer('kode_poli')->nullable()->default(0)->comment('Primary Key');
            $table->integer('no_kunjungan')->nullable()->default(0);
            $table->string('kode_bagian', 18)->nullable();
            $table->smallInteger('no_antrian')->nullable()->default(0)->comment('Nomor antrian. Per tanggal,poli,dokter.');
            $table->dateTime('tgl_jam_poli')->nullable()->useCurrent();
            $table->string('kode_dokter', 15)->nullable()->default('0');
            $table->integer('kode_resep')->nullable()->default(0);
            $table->string('kode_gcu', 10)->nullable();
            $table->integer('status_periksa')->nullable()->default(0)->comment('Masih diperiksa=0; Udah pulang=1');
            $table->string('no_induk', 50)->nullable();
            $table->integer('kode_jadwal')->nullable();
            $table->integer('status_isihasil')->nullable();
            $table->integer('status_bayar')->nullable();
            $table->decimal('datang', 18)->nullable();
            $table->integer('id_mt_jadwal_dokter')->nullable();
            $table->integer('status_batal')->nullable();
            $table->string('jam_praktek', 50)->nullable();
            $table->integer('no_antrian_bpjs')->nullable();
            $table->integer('no_antrian_umum')->nullable();
            $table->dateTime('tgl_jam_panggil')->nullable();
            $table->dateTime('tgl_jam_keluar')->nullable();
            $table->integer('status_panggil')->nullable();
            $table->integer('status_keluar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pl_tc_poli_2023');
    }
};
