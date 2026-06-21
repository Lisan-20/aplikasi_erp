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
        if (Schema::hasTable('th_laporan_pembedahan')) {
            return;
        }

        Schema::create('th_laporan_pembedahan', function (Blueprint $table) {
            $table->increments('id_laporan_pembedahan');
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('operator_dpjp_tambah', 50)->nullable();
            $table->string('dpjp_anes', 50)->nullable();
            $table->string('staff_anes', 50)->nullable();
            $table->string('asisten', 50)->nullable();
            $table->string('instrumen', 50)->nullable();
            $table->string('sirkuler', 50)->nullable();
            $table->text('diag_pra_bedah')->nullable();
            $table->dateTime('tgl_trans_bedah')->nullable();
            $table->text('diag_pas_bedah')->nullable();
            $table->string('mulai_bedah', 10)->nullable();
            $table->string('selesai_bedah', 10)->nullable();
            $table->string('jenis_bedah', 10)->nullable();
            $table->integer('kelompok_pas')->nullable();
            $table->string('kelompok_lain', 10)->nullable();
            $table->text('tind_bedah')->nullable();
            $table->string('jenis_pembedahan', 10)->nullable();
            $table->string('operasi_ke', 10)->nullable();
            $table->string('tipe_anes', 10)->nullable();
            $table->string('profiaksis', 10)->nullable();
            $table->string('antibiotik', 10)->nullable();
            $table->string('dosis', 10)->nullable();
            $table->string('jam', 10)->nullable();
            $table->text('konsul_io')->nullable();
            $table->text('rencana_tindak_lanjut')->nullable();
            $table->text('komplikasi')->nullable();
            $table->string('tipe_anes_lain', 50)->nullable();
            $table->dateTime('tgl_patologi')->nullable();
            $table->string('jaringan_pat', 10)->nullable();
            $table->string('jml_pendrhn', 10)->nullable();
            $table->string('jml_transfusi', 10)->nullable();
            $table->string('jenis_implant', 10)->nullable();
            $table->string('no_implant', 50)->nullable();
            $table->string('diet_lain', 10)->nullable();
            $table->string('jenis_jaringan', 10)->nullable();
            $table->integer('user_id')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('diet', 10)->nullable();
            $table->string('mulai_op', 8)->nullable();
            $table->string('insisi', 20)->nullable();
            $table->string('uterus', 10)->nullable();
            $table->string('cara_lahir', 10)->nullable();
            $table->string('jen_kelamin_bayi', 12)->nullable();
            $table->string('berat_bdn', 10)->nullable();
            $table->string('pjg_bdn', 10)->nullable();
            $table->string('lgkr_bdn', 10)->nullable();
            $table->string('lgkr_prt', 10)->nullable();
            $table->string('presentasi', 10)->nullable();
            $table->string('ketuban', 15)->nullable();
            $table->string('asering', 10)->nullable();
            $table->string('nacl', 10)->nullable();
            $table->string('drh_masuk', 10)->nullable();
            $table->string('drh_keluar', 10)->nullable();
            $table->string('urine', 10)->nullable();
            $table->string('saat_op', 10)->nullable();
            $table->string('selesai_op', 10)->nullable();
            $table->string('lahir_bayi', 10)->nullable();
            $table->integer('ag_skor')->nullable();
            $table->integer('ag_skor1')->nullable();
            $table->string('by_lhr_menangis', 2)->nullable();
            $table->string('penghisap', 2)->nullable();
            $table->string('aktif_bayi', 2)->nullable();
            $table->string('sesak_bayi', 2)->nullable();
            $table->string('retraksi', 2)->nullable();
            $table->string('bak', 2)->nullable();
            $table->string('meko', 2)->nullable();
            $table->string('caput', 2)->nullable();
            $table->string('cacat', 2)->nullable();
            $table->string('kemerahan', 2)->nullable();
            $table->string('tl_pst', 2)->nullable();
            $table->string('anus_lgkp', 2)->nullable();
            $table->string('jns_ketuban', 20)->nullable();
            $table->string('jml_ketuban', 10)->nullable();
            $table->string('lahir_dengan', 20)->nullable();
            $table->string('cara_lhr_bayi', 20)->nullable();
            $table->string('pjg_tl_pst', 20)->nullable();
            $table->string('brt_tl_pst', 20)->nullable();
            $table->string('uk1', 10)->nullable();
            $table->string('uk2', 10)->nullable();
            $table->string('uk3', 10)->nullable();
            $table->string('kedua_tuba', 10)->nullable();
            $table->string('ovu_kiri', 10)->nullable();
            $table->string('ovu_kanan', 10)->nullable();
            $table->text('prosedur_bdh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_laporan_pembedahan');
    }
};
