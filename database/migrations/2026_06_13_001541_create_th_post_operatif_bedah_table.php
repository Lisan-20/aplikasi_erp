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
        if (Schema::hasTable('th_post_operatif_bedah')) {
            return;
        }

        Schema::create('th_post_operatif_bedah', function (Blueprint $table) {
            $table->increments('id_th_post_operatif_op');
            $table->string('nama_pasien', 50)->nullable();
            $table->string('no_mr', 20)->nullable();
            $table->string('no_kunjungan', 20)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('diag_pas_bedah', 50)->nullable();
            $table->string('dr_operator', 50)->nullable();
            $table->string('dr_anestesi', 50)->nullable();
            $table->string('sirkuler', 50)->nullable();
            $table->string('asisten', 50)->nullable();
            $table->string('perawat', 50)->nullable();
            $table->dateTime('tgl_masuk_bedah')->nullable();
            $table->string('tindakan', 50)->nullable();
            $table->string('rr_io', 10)->nullable();
            $table->string('spo2_io', 10)->nullable();
            $table->string('o2_io', 10)->nullable();
            $table->string('normal_io', 7)->nullable();
            $table->string('gd_kanan_io', 7)->nullable();
            $table->string('gd_kiri_io', 7)->nullable();
            $table->string('pola_nfs_io', 10)->nullable();
            $table->string('txt_suara_nfs', 20)->nullable();
            $table->string('suara_nfs_kanan_io', 7)->nullable();
            $table->string('suara_nfs_kiri_io', 7)->nullable();
            $table->string('alt_bntu_nfs', 10)->nullable();
            $table->string('txt_alt_bntu_nfs', 20)->nullable();
            $table->string('crt_io', 10)->nullable();
            $table->string('td', 10)->nullable();
            $table->string('nadi_io', 10)->nullable();
            $table->string('suhu_io', 10)->nullable();
            $table->string('kulit_io', 12)->nullable();
            $table->string('txt_kulit_io', 20)->nullable();
            $table->string('pendrhan_io', 7)->nullable();
            $table->string('txt_pendrhan_io', 20)->nullable();
            $table->string('kesdran_io', 20)->nullable();
            $table->string('txt_gcs_io', 20)->nullable();
            $table->string('kateter_io', 12)->nullable();
            $table->string('txt_kateter_io', 20)->nullable();
            $table->string('pas_op_io', 20)->nullable();
            $table->string('turgor_klt', 12)->nullable();
            $table->string('implan_io', 7)->nullable();
            $table->string('txt_jenis_implan_io', 12)->nullable();
            $table->string('mual_post', 7)->nullable();
            $table->string('muntah_post', 7)->nullable();
            $table->string('txt_muntah_post', 12)->nullable();
            $table->string('drain_post', 20)->nullable();
            $table->string('txt_drain_post', 12)->nullable();
            $table->string('warna_post', 12)->nullable();
            $table->string('jenis_implan_post', 20)->nullable();
            $table->string('ngt_post', 20)->nullable();
            $table->string('txt_ngt_post', 20)->nullable();
            $table->string('tampon_post', 20)->nullable();
            $table->string('jenis_tampon_post', 20)->nullable();
            $table->string('jaringan_post', 20)->nullable();
            $table->string('periksa_post', 20)->nullable();
            $table->string('as_post', 20)->nullable();
            $table->string('stw_post', 20)->nullable();
            $table->string('bmg_post', 20)->nullable();
            $table->string('jm_pggl_prwt_post', 10)->nullable();
            $table->string('jm_pggl_pas_post', 10)->nullable();
            $table->string('hipo_bd_io', 20)->nullable();
            $table->text('hipo_suhu_io')->nullable();
            $table->text('hipo_kemmpuan_krgt_io')->nullable();
            $table->text('observasi_vtl_io')->nullable();
            $table->text('atur_posisi_nymn_io')->nullable();
            $table->text('impl_observasi_vtl_io')->nullable();
            $table->text('impl_atur_posisi_nymn_io')->nullable();
            $table->string('eva_observasi_vtl_io', 7)->nullable();
            $table->string('eva_atur_posisi_nymn_io_bd', 7)->nullable();
            $table->text('krskan_kulit_bd_io')->nullable();
            $table->text('tind_invasif_io')->nullable();
            $table->text('bersihan_jln_nfs_io')->nullable();
            $table->text('Penyempitan_bronkus_io')->nullable();
            $table->text('klmhan_otot_nfs_io_bd')->nullable();
            $table->text('prdksi_scrt_lbh_io_bd')->nullable();
            $table->text('psg_pngmn_tt_io_bd')->nullable();
            $table->text('selimut_io_bd')->nullable();
            $table->text('trpi_o2_io_bd')->nullable();
            $table->text('impl_psg_pngmn_tt_io_bd')->nullable();
            $table->text('impl_selimut_io_bd')->nullable();
            $table->text('impl_trpi_o2_io_bd')->nullable();
            $table->string('eva_psg_pngmn_tt_io_bd', 7)->nullable();
            $table->string('eva_selimut_io_bd', 7)->nullable();
            $table->string('eva_trpi_o2_io_bd', 7)->nullable();
            $table->text('nyeri_bd')->nullable();
            $table->text('luka_op_io')->nullable();
            $table->text('hilang_efek_anes_io_bd')->nullable();
            $table->text('mntr_jln_nfs')->nullable();
            $table->text('syok_io_bd')->nullable();
            $table->text('impl_mntr_jln_nfs')->nullable();
            $table->text('impl_syok_io_bd')->nullable();
            $table->string('eva_mntr_jln_nfs', 7)->nullable();
            $table->string('eva_syok_io_bd', 7)->nullable();
            $table->text('cemas_bd_io')->nullable();
            $table->text('cemas_knsp_diri_io')->nullable();
            $table->text('cemas_status_sosial_io')->nullable();
            $table->text('cemas_status_lgkngan_io')->nullable();
            $table->text('serh_terima_pas')->nullable();
            $table->text('impl_serh_terima_pas')->nullable();
            $table->text('eva_serh_terima_pas')->nullable();
            $table->text('txt_operan')->nullable();
            $table->integer('user_idx');
            $table->dateTime('tgl_input')->nullable();
            $table->dateTime('tgl_masuk_pas')->nullable();
            $table->string('pindah_rg_post', 7)->nullable();
            $table->string('txt_rg_post', 7)->nullable();
            $table->string('ket_post', 20)->nullable();
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_post_operatif_bedah');
    }
};
