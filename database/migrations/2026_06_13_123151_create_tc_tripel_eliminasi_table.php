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
        if (Schema::hasTable('tc_tripel_eliminasi')) {
            return;
        }

        Schema::create('tc_tripel_eliminasi', function (Blueprint $table) {
            $table->increments('id_tripel');
            $table->string('faskes', 250)->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->dateTime('tgl_entry')->nullable();
            $table->integer('id_user')->nullable();
            $table->string('nik', 50)->nullable();
            $table->string('no_kk', 50)->nullable();
            $table->string('desa', 250)->nullable();
            $table->string('kecamatan', 250)->nullable();
            $table->string('kabupaten', 250)->nullable();
            $table->string('provinsi', 250)->nullable();
            $table->integer('text_G')->nullable();
            $table->integer('text_P')->nullable();
            $table->integer('text_A')->nullable();
            $table->integer('umur_kehamilan')->nullable();
            $table->string('tgl_taksiran', 250)->nullable();
            $table->string('HBaAg_tgl', 250)->nullable();
            $table->string('HIV_tgl', 250)->nullable();
            $table->string('Sifilis_tgl', 250)->nullable();
            $table->string('HBaAg_kode', 250)->nullable();
            $table->string('HIV_kode', 250)->nullable();
            $table->string('Sifilis_kode', 250)->nullable();
            $table->string('HBaAg_hasil', 250)->nullable();
            $table->string('HIV_hasil', 250)->nullable();
            $table->string('Sifilis_hasil', 250)->nullable();
            $table->string('HIV_tgl_pdp', 250)->nullable();
            $table->string('HIV_tgl_arv', 250)->nullable();
            $table->string('Sifilis_ditangani', 250)->nullable();
            $table->string('Sifilis_diobati', 250)->nullable();
            $table->string('HBaAg_dirujuk', 250)->nullable();
            $table->string('HIV_pasangan', 250)->nullable();
            $table->string('Sifilis_pasangan', 250)->nullable();
            $table->string('status', 250)->nullable();
            $table->string('tgl_jam_persalinan', 250)->nullable();
            $table->integer('jml_anak_dlahirkan')->nullable();
            $table->string('tmp_persalinan', 250)->nullable();
            $table->string('HBO_tgl', 250)->nullable();
            $table->string('DPT_HB1', 250)->nullable();
            $table->string('DPT_HB2', 250)->nullable();
            $table->string('DPT_HB3', 250)->nullable();
            $table->string('HBIG_tgl', 250)->nullable();
            $table->string('HBsAg_bayi', 250)->nullable();
            $table->string('anti_HBS', 250)->nullable();
            $table->string('HBsAg_bayi_hasil', 250)->nullable();
            $table->string('anti_HBS_hasil', 250)->nullable();
            $table->string('pemberian_ARV', 250)->nullable();
            $table->string('DBS_EID', 250)->nullable();
            $table->string('konf_EID', 250)->nullable();
            $table->string('balita_indikasi_HIV', 250)->nullable();
            $table->string('balita_HIV_PDP', 250)->nullable();
            $table->string('balita_HIV_ARV', 250)->nullable();
            $table->string('bayi_ibu_dirujuk', 250)->nullable();
            $table->string('umur_2th_sifilis', 250)->nullable();
            $table->string('DBS_EID_hasil', 250)->nullable();
            $table->string('konf_EID_hasil', 250)->nullable();
            $table->string('balita_indikasi_HIV_hasil', 250)->nullable();
            $table->integer('kode_rm')->nullable();
            $table->string('faskes_rujukan', 250)->nullable();
            $table->string('umur_2th_tgl', 250)->nullable();
            $table->string('umur_2th_hasil', 250)->nullable();
            $table->string('gol_darah', 250)->nullable();
            $table->string('umur_pasien', 250)->nullable();
            $table->string('pendidikan', 250)->nullable();
            $table->string('pekerjaan', 250)->nullable();
            $table->string('nama_faskes_atas', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_tripel_eliminasi');
    }
};
