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
        if (Schema::hasTable('th_intra_operatif_bedah')) {
            return;
        }

        Schema::create('th_intra_operatif_bedah', function (Blueprint $table) {
            $table->increments('id_th_intra_operatif_bedah');
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
            $table->string('mulai_bedah', 10)->nullable();
            $table->string('selesai_bedah', 10)->nullable();
            $table->string('tipe_anes', 10)->nullable();
            $table->string('posisi_tangan', 20)->nullable();
            $table->string('infus_tangan', 20)->nullable();
            $table->string('txt_posisi_operasi', 20)->nullable();
            $table->string('posisi_op', 20)->nullable();
            $table->string('rr_io', 20)->nullable();
            $table->string('spo2_io', 20)->nullable();
            $table->string('o2_io', 20)->nullable();
            $table->string('hasil_ro_io', 20)->nullable();
            $table->string('normal_io', 7)->nullable();
            $table->string('gd_kanan_io', 7)->nullable();
            $table->string('gd_kiri_io', 7)->nullable();
            $table->string('pola_nfs_io', 10)->nullable();
            $table->string('suara_nafas', 10)->nullable();
            $table->string('suara_nfs_kanan_io', 10)->nullable();
            $table->string('suara_nfs_kiri_io', 10)->nullable();
            $table->string('crt_io', 10)->nullable();
            $table->string('td', 10)->nullable();
            $table->string('nadi_io', 8)->nullable();
            $table->string('suhu_io', 8)->nullable();
            $table->string('kulit_io', 10)->nullable();
            $table->string('txt_kulit_io', 20)->nullable();
            $table->string('pendrhan_io', 8)->nullable();
            $table->string('msn_kouter', 10)->nullable();
            $table->string('txt_monopolar', 20)->nullable();
            $table->string('txt_bipolar', 20)->nullable();
            $table->string('txt_coag', 20)->nullable();
            $table->string('txt_cutting', 20)->nullable();
            $table->string('txt_lokasi_io', 20)->nullable();
            $table->string('txt_insisi_io', 20)->nullable();
            $table->string('kesdran_io', 20)->nullable();
            $table->string('txt_gcs', 10)->nullable();
            $table->string('kateter_io', 10)->nullable();
            $table->string('txt_kateter_io', 10)->nullable();
            $table->string('bb_io', 7)->nullable();
            $table->string('tb_io', 20)->nullable();
            $table->string('puasa_io', 7)->nullable();
            $table->string('mual_io', 7)->nullable();
            $table->string('muntah_io', 7)->nullable();
            $table->string('distensi_io', 10)->nullable();
            $table->string('drain_io', 7)->nullable();
            $table->string('txt_drain_io', 20)->nullable();
            $table->string('ngt_io', 20)->nullable();
            $table->string('warna_io', 20)->nullable();
            $table->string('pth_tlg_io', 20)->nullable();
            $table->string('implan_io', 20)->nullable();
            $table->string('lokasi_io', 20)->nullable();
            $table->string('jenis_io', 20)->nullable();
            $table->string('irigasi_io', 7)->nullable();
            $table->string('jns_obat_io', 20)->nullable();
            $table->string('kasa_pre_io', 20)->nullable();
            $table->string('kasa_post_io', 20)->nullable();
            $table->string('jarum_pre_io', 20)->nullable();
            $table->string('jarum_post_io', 20)->nullable();
            $table->string('bisturi_pre_io', 20)->nullable();
            $table->string('bisturi_post_io', 20)->nullable();
            $table->string('instrumen_pre_io', 20)->nullable();
            $table->string('instrumen_post_io', 20)->nullable();
            $table->string('big_hass_pre_io', 20)->nullable();
            $table->string('big_hass_post_io', 20)->nullable();
            $table->string('pemeriksa_io', 20)->nullable();
            $table->string('penghitung_io', 20)->nullable();
            $table->string('cemas_bd_io', 50)->nullable();
            $table->string('cemas_pros_op_io', 50)->nullable();
            $table->string('cemas_kematian_io', 50)->nullable();
            $table->string('cemas_pros_op_lain_io', 50)->nullable();
            $table->string('txt_cemas_pros_op_lain_io', 50)->nullable();
            $table->string('siap_ro_io', 50)->nullable();
            $table->string('siap_linen_io', 50)->nullable();
            $table->string('siap_pas_meja_io', 50)->nullable();
            $table->string('impl_siap_ro_io', 50)->nullable();
            $table->string('impl_siap_linen_io', 50)->nullable();
            $table->string('impl_siap_pas_op_io', 50)->nullable();
            $table->string('siap_ro_evaluasi_bd', 7)->nullable();
            $table->string('siap_linen_io_evaluasi_bd', 7)->nullable();
            $table->string('siap_pas_op_evaluasi_bd', 7)->nullable();
            $table->string('krskan_kulit_bd_io', 20)->nullable();
            $table->string('tind_invasif_io', 50)->nullable();
            $table->string('tind_lain_io', 50)->nullable();
            $table->string('txt_tind_lain_io', 50)->nullable();
            $table->string('bantu_anes_io_bd', 50)->nullable();
            $table->string('impl_bantu_anes_io_bd', 50)->nullable();
            $table->string('eva_bantu_anes_io_bd', 7)->nullable();
            $table->string('resiko_infeksi_bd', 20)->nullable();
            $table->string('luka_trbka_io', 50)->nullable();
            $table->string('txt_luka_trbka_io', 50)->nullable();
            $table->string('insisi_io', 20)->nullable();
            $table->string('trauma_jrgn_io', 50)->nullable();
            $table->string('atur_posisi_pas_io', 50)->nullable();
            $table->string('obsrvasi_vital_io', 50)->nullable();
            $table->string('siap_diri_io', 50)->nullable();
            $table->string('impl_atur_posisi_pas_io', 50)->nullable();
            $table->string('impl_obsrvasi_vital_io', 50)->nullable();
            $table->string('impl_siap_diri_io', 50)->nullable();
            $table->string('eva_atur_posisi_pas_io', 7)->nullable();
            $table->string('eva_obsrvasi_vital_io', 7)->nullable();
            $table->string('eva_siap_diri_io', 7)->nullable();
            $table->string('hipotermi_io_bd', 50)->nullable();
            $table->string('suhu_lngkngan_io_bd', 50)->nullable();
            $table->string('pnrunan_krgt_bd', 50)->nullable();
            $table->string('brkan_selimut_bd', 8)->nullable();
            $table->string('impl_brkan_selimut_bd', 8)->nullable();
            $table->string('eva_brkan_selimut_bd', 7)->nullable();
            $table->string('bersihan_jln_nfs_io', 50)->nullable();
            $table->string('Penyempitan_bronkus_io', 50)->nullable();
            $table->string('klmhan_otot_nfs_io_bd', 50)->nullable();
            $table->string('pmbtsan_fisik_io_bd', 50)->nullable();
            $table->string('prdksi_scrt_lbh_io_bd', 50)->nullable();
            $table->string('btk_tdk_efektif_io_bd', 50)->nullable();
            $table->string('htg_jmlh_alkes_io_bd', 50)->nullable();
            $table->string('steril_bedah_io_bd', 50)->nullable();
            $table->string('impl_htg_jmlh_alkes_io_bd', 50)->nullable();
            $table->string('impl_steril_bedah_io_bd', 50)->nullable();
            $table->string('eva_htg_jmlh_alkes_io_bd', 7)->nullable();
            $table->string('eva_steril_bedah_io_bd', 7)->nullable();
            $table->string('gangguan_pertukaran_gas_io_bd', 20)->nullable();
            $table->string('txt_gangguan_pertukaran_gas_io_bd', 50)->nullable();
            $table->string('pola_nfs_tdk_efektif_io_bd', 50)->nullable();
            $table->string('txt_pola_nfs_tdk_efektif_io_bd', 50)->nullable();
            $table->string('prsiapan_area_op_io_bd', 20)->nullable();
            $table->string('impl_prsiapan_area_op_io_bd', 20)->nullable();
            $table->string('eva_prsiapan_area_op_io_bd', 7)->nullable();
            $table->string('resiko_cdr_io_bd', 50)->nullable();
            $table->string('posisi_op_tdk_tpt_io_bd', 50)->nullable();
            $table->string('bnda_asing_io_bd', 50)->nullable();
            $table->string('lk_bkr_io_bd', 50)->nullable();
            $table->string('lkukan_timeout_io_bd', 20)->nullable();
            $table->string('lkukan_signout_io_bd', 20)->nullable();
            $table->string('impl_lkukan_timeout_io_bd', 20)->nullable();
            $table->string('impl_lkukan_signout_io_bd', 20)->nullable();
            $table->string('eva_lkukan_timeout_io_bd', 7)->nullable();
            $table->string('eva_lkukan_signout_io_bd', 7)->nullable();
            $table->dateTime('tgl_masuk_pas')->nullable();
            $table->integer('user_id')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('jam_masuk_pas', 10)->nullable();
            $table->string('txt_pendrhan_io', 50)->nullable();
            $table->string('txt_gguan_tukar_gas_io', 50)->nullable();
            $table->text('txt_operan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_intra_operatif_bedah');
    }
};
