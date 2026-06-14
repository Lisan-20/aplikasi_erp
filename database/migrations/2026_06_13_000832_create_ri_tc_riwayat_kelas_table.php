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
        if (Schema::hasTable('ri_tc_riwayat_kelas')) {
            return;
        }

        Schema::create('ri_tc_riwayat_kelas', function (Blueprint $table) {
            $table->increments('kode_riw_klas');
            $table->integer('kode_ri')->nullable();
            $table->string('kode_kunjungan', 18)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->string('kode_dokter', 10)->nullable();
            $table->string('kode_ruangan', 6)->nullable();
            $table->string('bagian_tujuan', 20)->nullable();
            $table->integer('kelas_tujuan')->nullable();
            $table->string('no_kamar_tujuan', 50)->nullable();
            $table->string('no_bed_tujuan', 50)->nullable();
            $table->string('bagian_asal', 20)->nullable();
            $table->integer('kelas_asal')->nullable();
            $table->string('no_kamar_asal', 50)->nullable();
            $table->string('no_bed_asal', 50)->nullable();
            $table->integer('harga')->nullable();
            $table->dateTime('tgl_masuk')->nullable();
            $table->dateTime('tgl_pindah')->nullable();
            $table->integer('ket_masuk')->nullable();
            $table->integer('ket_pindah')->nullable();
            $table->integer('ket_keluar')->nullable();
            $table->integer('status_hidup')->nullable();
            $table->string('kode_kematian', 20)->nullable();
            $table->dateTime('waktu_kematian')->nullable();
            $table->string('no_kamar_asli', 50)->nullable();
            $table->string('no_bed_asli', 50)->nullable();
            $table->integer('flagtitip')->nullable();

            $table->primary(['kode_riw_klas'], 'pk__ri_tc_riwayat_ke__540324b6');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ri_tc_riwayat_kelas');
    }
};
