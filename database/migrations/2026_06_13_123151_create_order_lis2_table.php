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
        Schema::create('order_lis2', function (Blueprint $table) {
            $table->increments('id_list');
            $table->integer('kode_penunjang')->nullable();
            $table->integer('kode_tarif')->nullable();
            $table->bigInteger('kode_mt_hasilpm')->nullable();
            $table->text('nama_tindakan')->nullable();
            $table->string('nama_pemeriksaan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
            $table->string('kode_dokter1', 20)->nullable();
            $table->string('kode_dokter2', 20)->nullable();
            $table->string('kode_bagian')->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->string('jen_kelamin', 10)->nullable();
            $table->integer('status_daftar')->nullable();
            $table->text('catatan')->nullable();
            $table->dateTime('waktu_sample')->nullable();
            $table->text('nama_pasien')->nullable();
            $table->dateTime('tgl_lhr')->nullable();
            $table->string('nama_ruang', 25)->nullable();
            $table->string('kode_ruang', 10)->nullable();
            $table->string('jns_rawat', 5)->nullable();
            $table->text('alamat')->nullable();
            $table->text('hasil')->nullable();
            $table->string('nilai_rujuk', 100)->nullable();
            $table->string('satuan', 50)->nullable();
            $table->integer('keterangan')->nullable();
            $table->integer('status_lis')->nullable();
            $table->integer('type_hasil')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_lis2');
    }
};
