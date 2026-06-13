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
        if (Schema::hasTable('th_pre_operatif_bedah')) {
            return;
        }

        Schema::create('th_pre_operatif_bedah', function (Blueprint $table) {
            $table->increments('id_th_pre_operatif');
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
            $table->string('rr', 10)->nullable();
            $table->string('spo2', 10)->nullable();
            $table->string('hasil_ro', 7)->nullable();
            $table->string('txt_hasil_ro', 10)->nullable();
            $table->string('gd_kanan', 7)->nullable();
            $table->string('gd_kiri', 7)->nullable();
            $table->string('pola_nfs', 10)->nullable();
            $table->string('suara_nfs_kanan', 7)->nullable();
            $table->string('suara_nfs_kiri', 7)->nullable();
            $table->string('crt', 8)->nullable();
            $table->string('td', 10)->nullable();
            $table->string('nadi', 10)->nullable();
            $table->string('suhu', 10)->nullable();
            $table->string('kulit', 10)->nullable();
            $table->string('pendrhan', 7)->nullable();
            $table->string('txt_pendrhan', 10)->nullable();
            $table->string('kesdran', 12)->nullable();
            $table->string('gcs_1', 8)->nullable();
            $table->string('txt_gcs_1', 10)->nullable();
            $table->string('gcs_2', 8)->nullable();
            $table->string('txt_gcs_2', 10)->nullable();
            $table->string('gcs_3', 8)->nullable();
            $table->string('txt_gcs_3', 10)->nullable();
            $table->integer('skala_nyeri')->nullable();
            $table->string('kateter', 7)->nullable();
            $table->string('txt_kateter', 10)->nullable();
            $table->string('bb', 10)->nullable();
            $table->string('tb', 10)->nullable();
            $table->string('puasa', 10)->nullable();
            $table->string('mual', 10)->nullable();
            $table->string('muntah', 10)->nullable();
            $table->string('ngt', 4)->nullable();
            $table->string('txt_ngt', 10)->nullable();
            $table->string('distensi', 10)->nullable();
            $table->string('gula_drh', 10)->nullable();
            $table->string('pth_tlg', 7)->nullable();
            $table->string('psikis', 20)->nullable();
            $table->string('alergi', 7)->nullable();
            $table->string('txt_alergi', 20)->nullable();
            $table->string('edukasi_1', 20)->nullable();
            $table->string('edukasi_2', 20)->nullable();
            $table->string('edukasi_3', 20)->nullable();
            $table->string('edukasi_4', 20)->nullable();
            $table->string('txt_edukasi_4', 20)->nullable();
            $table->string('txt_cairan_ke', 20)->nullable();
            $table->string('antibiotik', 20)->nullable();
            $table->string('dosis', 20)->nullable();
            $table->string('cemas_bd', 50)->nullable();
            $table->string('cemas_pros_op', 50)->nullable();
            $table->string('cemas_kematian', 50)->nullable();
            $table->string('kaji_sebab_bd', 50)->nullable();
            $table->string('tanya_kaji_sebab_evaluasi_bd', 7)->nullable();
            $table->string('nyeri_bd', 20)->nullable();
            $table->string('nyeri_pros_penyakit', 20)->nullable();
            $table->string('nyeri_pros_lain', 20)->nullable();
            $table->string('txt_nyeri_pros_lain', 20)->nullable();
            $table->string('interaksi_sosial_bd', 20)->nullable();
            $table->string('impl_interaksi_sosial_bd', 50)->nullable();
            $table->string('eva_interaksi_sosial_bd', 7)->nullable();
            $table->string('pola_nafas_bd', 20)->nullable();
            $table->string('txt_pola_nafas_bd', 20)->nullable();
            $table->string('terangkan_teknik_relaksasi', 20)->nullable();
            $table->string('terapkan_teknik_relaksasi', 20)->nullable();
            $table->string('eva_teknik_relaksasi', 7)->nullable();
            $table->string('bersihan_nfs_bd', 50)->nullable();
            $table->string('bersihan_pympitan_bd', 50)->nullable();
            $table->string('lmh_otot_nfs_bd', 50)->nullable();
            $table->string('akumulasi_scret_bd', 50)->nullable();
            $table->string('prod_scret_brlbhan_bd', 50)->nullable();
            $table->string('btk_tdk_efektif_bd', 50)->nullable();
            $table->string('cek_kelengkapan_dok_bd', 50)->nullable();
            $table->string('orientasi_po_bd', 50)->nullable();
            $table->string('observasi_vital_bd', 50)->nullable();
            $table->string('melakukan_serah_terima_bd', 50)->nullable();
            $table->string('aksi_orientasi_po_bd', 50)->nullable();
            $table->string('aksi_observasi_vital_bd', 50)->nullable();
            $table->string('eva_serah_terima_bd', 8)->nullable();
            $table->string('eva_orientasi_po_bd', 8)->nullable();
            $table->string('eva_observasi_bd', 8)->nullable();
            $table->string('prbhn_fisik_bd', 50)->nullable();
            $table->string('kelumpuhan_bd', 50)->nullable();
            $table->string('klmhan_fisik_bd', 50)->nullable();
            $table->string('pmbtsan_fisik_bd', 50)->nullable();
            $table->string('persiapkan_msn_anes_db', 50)->nullable();
            $table->string('persiapkan_instrumen_anes_db', 50)->nullable();
            $table->string('mempersiapkan_msn_anes_db', 50)->nullable();
            $table->string('mempersiapkan_instrument_anes_db', 50)->nullable();
            $table->string('eva_persiapkan_msn_anes_db', 7)->nullable();
            $table->string('eva_persiapkan_instrumen_anes_dbx', 7)->nullable();
            $table->string('gangguan_komunikasi_bd', 50)->nullable();
            $table->string('khlngan_tenang_bd', 50)->nullable();
            $table->string('tdk_mgrti_bhs_bd', 50)->nullable();
            $table->string('kolab_pmbrian_obat_bd', 50)->nullable();
            $table->string('memstikan_obat_bd', 50)->nullable();
            $table->string('eva_obat_db', 7)->nullable();
            $table->string('krg_pgthuan_bd', 50)->nullable();
            $table->string('krg_info_tentang_bd', 50)->nullable();
            $table->string('txt_krg_info_tentang_bd', 50)->nullable();
            $table->string('pros_pmbedahan_bd', 50)->nullable();
            $table->string('pnykt_diderita_bd', 50)->nullable();
            $table->string('observasi_efek_smping_obat_anes_dbx', 50)->nullable();
            $table->string('mobilisasi_pas_db', 50)->nullable();
            $table->string('komunikasi_pas_db', 50)->nullable();
            $table->string('pros_signin_pas_db', 50)->nullable();
            $table->string('observasi_efek_medikasi_db', 50)->nullable();
            $table->string('bantu_mobilisasi_pas_db', 50)->nullable();
            $table->string('pelibatan_keluarga_komunikasi_dbx', 50)->nullable();
            $table->string('pelaksanaan_pros_signin_db', 50)->nullable();
            $table->string('eva_observasi_efek_smping_medika_dbx', 7)->nullable();
            $table->string('eva_mobilisasi_pas_db', 7)->nullable();
            $table->string('eva_pelibatan_keluarga_komunikasi_dbx', 7)->nullable();
            $table->string('eva_pelaksanaan_pros_signin_db', 7)->nullable();
            $table->integer('user_id')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->dateTime('tgl_masuk_pas')->nullable();
            $table->string('o2', 7)->nullable();
            $table->text('tanya_kaji_sebab_bd')->nullable();
            $table->string('suara_nafas', 50)->nullable();
            $table->string('observasix', 50)->nullable();
            $table->string('observ_efek_smping_obatx', 50)->nullable();
            $table->string('obs_efek_obt', 50)->nullable();
            $table->string('siap_instru_anes', 50)->nullable();
            $table->string('pelibatan_keluarga', 50)->nullable();
            $table->string('eva_pelibatan_keluarga', 50)->nullable();
            $table->string('eva_obs_efek_smpg_mdk', 50)->nullable();
            $table->string('eva_siap_inst_anes', 50)->nullable();
            $table->text('txt_operan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_pre_operatif_bedah');
    }
};
