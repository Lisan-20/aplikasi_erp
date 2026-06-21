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
        if (Schema::hasTable('gd_tc_gawat_darurat')) {
            return;
        }

        Schema::create('gd_tc_gawat_darurat', function (Blueprint $table) {
            $table->integer('kode_gd');
            $table->integer('no_kunjungan')->nullable();
            $table->string('kode_penyakit', 6)->nullable();
            $table->string('jns_celaka')->nullable();
            $table->dateTime('tanggal_gd')->nullable();
            $table->dateTime('tgl_kecelakaan')->nullable();
            $table->string('tmpt_kecelakaan', 20)->nullable();
            $table->string('dibawa_oleh', 30)->nullable();
            $table->string('bentuk_pelayanan', 20)->nullable();
            $table->string('pemberitahuan_ke', 10)->nullable();
            $table->string('oleh', 20)->nullable();
            $table->string('lapdr_keadaan')->nullable();
            $table->string('pengobatan')->nullable();
            $table->string('riwayat_singkat', 100)->nullable();
            $table->string('diagnosa_masuk')->nullable();
            $table->string('instruk_penyakit')->nullable();
            $table->dateTime('tgl_jam_msk')->nullable();
            $table->dateTime('tgl_jam_kel')->nullable();
            $table->string('doa', 20)->nullable();
            $table->integer('kd_tind_igd')->nullable();
            $table->string('no_induk', 50)->nullable();
            $table->string('tek_darah', 50)->nullable();
            $table->string('instr_lanj')->nullable();
            $table->string('instr_pend')->nullable();
            $table->string('asal_pasien', 50)->nullable();
            $table->string('dikirim_oleh', 50)->nullable();
            $table->string('dibawa_dgn', 50)->nullable();
            $table->string('kasus_polisi', 50)->nullable();
            $table->string('dokter_jaga', 50)->nullable();
            $table->text('nama_org_dekat')->nullable();
            $table->string('telp_org_dekat', 20)->nullable();
            $table->text('riwayat_kejadian')->nullable();
            $table->text('alamat_org_dekat')->nullable();
            $table->text('status_diterima')->nullable();
            $table->integer('kode_klas')->nullable();
            $table->string('kode_bagian', 18)->nullable()->default('20101')->comment('kode bagian gawat darurat :020101');
            $table->integer('flag_man')->nullable();
            $table->integer('status_periksa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gd_tc_gawat_darurat');
    }
};
