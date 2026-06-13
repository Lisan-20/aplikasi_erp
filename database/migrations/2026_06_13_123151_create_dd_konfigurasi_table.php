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
        Schema::create('dd_konfigurasi', function (Blueprint $table) {
            $table->increments('id_dd_konfigurasi');
            $table->string('kode_rs_old', 2)->nullable();
            $table->string('nama_perusahaan', 50)->nullable();
            $table->string('nama_singkat', 16)->nullable();
            $table->string('nama_aplikasi', 50)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->string('kota', 50)->nullable();
            $table->string('propinsi', 50)->nullable();
            $table->string('kode_pos', 6)->nullable();
            $table->string('telpon', 50)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('nama_pimpinan', 50)->nullable();
            $table->string('keterangan')->nullable();
            $table->string('logo', 50)->nullable();
            $table->string('logo_small', 50)->nullable();
            $table->string('html_title', 50)->nullable();
            $table->string('kode_rs', 12)->nullable();
            $table->integer('ko_wil')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('jenis_rs', 100)->nullable();
            $table->string('kelas_rs', 100)->nullable();
            $table->string('nama_penyelenggaran', 100)->nullable();
            $table->string('luas_rs_tanah', 100)->nullable();
            $table->string('luas_rs_bangunan', 100)->nullable();
            $table->string('iz_nomer', 100)->nullable();
            $table->dateTime('iz_tgl')->nullable();
            $table->string('iz_oleh', 100)->nullable();
            $table->string('iz_sifat', 100)->nullable();
            $table->dateTime('iz_masa_awal')->nullable();
            $table->dateTime('iz_masa_akhir')->nullable();
            $table->string('status_penyelenggara', 100)->nullable();
            $table->string('ak_tahap', 100)->nullable();
            $table->string('ak_status', 100)->nullable();
            $table->dateTime('ak_tgl_akreditasi')->nullable();

            $table->primary(['id_dd_konfigurasi'], 'pk_dd_konfigurasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_konfigurasi');
    }
};
