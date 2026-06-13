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
        if (Schema::hasTable('lap_kunjungan_gizi_temp')) {
            return;
        }

        Schema::create('lap_kunjungan_gizi_temp', function (Blueprint $table) {
            $table->string('Jenis_diet', 50)->nullable();
            $table->integer('ml_diet')->nullable();
            $table->integer('mb_diet')->nullable();
            $table->integer('mc')->nullable();
            $table->integer('b_saring')->nullable();
            $table->integer('b_tim')->nullable();
            $table->integer('ml_tanpa_diet')->nullable();
            $table->integer('mb_tanpa_diet')->nullable();
            $table->integer('jumlah_diet')->nullable();
            $table->string('jumlah_pasien_kelas', 50)->nullable();
            $table->integer('kelas_vvip')->nullable();
            $table->integer('kelas_vip')->nullable();
            $table->integer('kelas_I')->nullable();
            $table->integer('kelas_II')->nullable();
            $table->integer('kelas_III')->nullable();
            $table->integer('total_kelas')->nullable();
            $table->string('jumlah_hari_rawat', 50)->nullable();
            $table->integer('anak')->nullable();
            $table->integer('dewasa')->nullable();
            $table->integer('tota_hari')->nullable();
            $table->string('cara_pembayaran', 50)->nullable();
            $table->integer('umum')->nullable();
            $table->integer('bpjs_pbi')->nullable();
            $table->integer('bpjs_nonpbi')->nullable();
            $table->integer('jamkesda')->nullable();
            $table->integer('asuransi_lain')->nullable();
            $table->integer('perusahaan')->nullable();
            $table->integer('total_bayar')->nullable();
            $table->integer('mutu')->nullable();
            $table->integer('ketepatan_waktu')->nullable();
            $table->integer('jumlah_pasien_tepat')->nullable();
            $table->integer('jumlah_pasien')->nullable();
            $table->integer('presentase')->nullable();
            $table->integer('tepat_diet')->nullable();
            $table->integer('sisa_makan')->nullable();
            $table->integer('Bpjs_Ktngkrja')->nullable();
            $table->integer('bpjs_cob')->nullable();
            $table->integer('tgl')->nullable();
            $table->string('bln', 50)->nullable();
            $table->integer('thn')->nullable();
            $table->string('distribusi2', 50)->nullable();
            $table->integer('distribusi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_kunjungan_gizi_temp');
    }
};
