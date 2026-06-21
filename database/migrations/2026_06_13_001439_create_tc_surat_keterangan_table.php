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
        if (Schema::hasTable('tc_surat_keterangan')) {
            return;
        }

        Schema::create('tc_surat_keterangan', function (Blueprint $table) {
            $table->increments('id_surat');
            $table->string('no_surat', 50)->nullable();
            $table->integer('id_jenis_surat')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->dateTime('tgl_surat')->nullable();
            $table->dateTime('tgl_periksa')->nullable();
            $table->string('nama_pasien', 250)->nullable();
            $table->decimal('lama_skd', 19, 4)->nullable();
            $table->dateTime('tgl_awal')->nullable();
            $table->dateTime('tgl_akhir')->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('kd_dokter', 50)->nullable();
            $table->integer('no_urut_surat')->nullable();
            $table->decimal('umur', 18, 0)->nullable();
            $table->string('nama_ortu', 250)->nullable();
            $table->decimal('umur_ortu', 18, 0)->nullable();
            $table->string('nama_perusahaan', 250)->nullable();
            $table->string('alamat_ortu', 250)->nullable();
            $table->string('umurnya_ortu', 10)->nullable();
            $table->string('ket_sehat', 250)->nullable();
            $table->string('isi_G', 250)->nullable();
            $table->string('isi_P', 250)->nullable();
            $table->string('isi_A', 250)->nullable();
            $table->string('taksiran_persalinan', 250)->nullable();
            $table->string('isi_hamil', 250)->nullable();
            $table->string('kel_dari', 250)->nullable();
            $table->string('tgl_masuk', 250)->nullable();
            $table->string('tgl_keluar', 250)->nullable();
            $table->text('obat_rawat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_surat_keterangan');
    }
};
