<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE VIEW dbo.pm_pasienpm_v
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.kota, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.nama_panggilan, dbo.mt_master_pasien.nama_kel_pasien, 
                      dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.tempat_lahir, dbo.mt_master_pasien.almt_ttp_pasien, dbo.mt_master_pasien.tlp_almt_ttp, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.mt_master_pasien.suku, dbo.mt_master_pasien.nama_kel_ter, dbo.mt_master_pasien.nama_almt_kel, dbo.mt_master_pasien.hubungan_kel, dbo.mt_master_pasien.gol_darah, 
                      dbo.tc_registrasi.status_batal AS status_batal_reg, dbo.tc_registrasi.stat_pasien, dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal AS x, 
                      dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.status_masuk, dbo.tc_kunjungan.status_keluar, dbo.tc_kunjungan.status_cito, dbo.tc_kunjungan.keterangan, 
                      dbo.pm_tc_penunjang.kode_penunjang, dbo.pm_tc_penunjang.tgl_daftar, dbo.pm_tc_penunjang.kode_bagian, dbo.pm_tc_penunjang.no_antrian, dbo.pm_tc_penunjang.tgl_isihasil, 
                      dbo.pm_tc_penunjang.no_foto, dbo.pm_tc_penunjang.dr_pengirim, dbo.pm_tc_penunjang.petugas_input, dbo.pm_tc_penunjang.status_daftar, dbo.pm_tc_penunjang.radiografer, 
                      dbo.pm_tc_penunjang.petugas_isihasil, dbo.pm_tc_penunjang.catatan_hasil, dbo.pm_tc_penunjang.status_isihasil, dbo.tc_registrasi.no_induk, dbo.tc_registrasi.kode_perusahaan, 
                      dbo.tc_registrasi.no_registrasi, dbo.pm_tc_penunjang.kode_klas, dbo.pm_tc_penunjang.no_hasil_pm, dbo.pm_tc_penunjang.status_bayar, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_kunjungan.status_batal AS Expr1, dbo.tc_registrasi.status_man, dbo.pm_tc_penunjang.kode_dr_pengirim, dbo.pm_tc_penunjang.no_radio, dbo.tc_registrasi.noSep, 
                      dbo.pm_tc_penunjang.kd_dr_pengirim, dbo.pm_tc_penunjang.status_batal, dbo.pm_tc_penunjang.diagnosa, dbo.pm_tc_penunjang.asal_daftar AS kode_bagian_asal, 
                      dbo.pm_tc_penunjang.waktu_sampel, dbo.tc_registrasi.st_ass_awal_fisio, dbo.tc_registrasi.st_ass_inv_fisio, dbo.tc_registrasi.st_ass_awal_hemo, dbo.tc_registrasi.st_ass_inv_hemo, 
                      dbo.tc_registrasi.st_ass_plk_hemo, dbo.mt_master_pasien.st_resum, dbo.mt_master_pasien.st_alergi, dbo.pm_tc_penunjang.ket_pm, dbo.tc_registrasi.kode_dokter, dbo.tc_registrasi.flag_ver, 
                      dbo.tc_registrasi.user_ver, dbo.tc_registrasi.tgl_ver, dbo.tc_registrasi.tgl_jam_plk_hemo, dbo.tc_registrasi.id_user_plk_hemo, dbo.tc_registrasi.tgl_jam_inv_hemo, 
                      dbo.tc_registrasi.id_user_inv_hemo, dbo.tc_registrasi.tgl_jam_inv_fisio, dbo.tc_registrasi.id_user_inv_fisio, dbo.tc_registrasi.id_user_fisio, dbo.tc_registrasi.tgl_jam_fisio, 
                      dbo.tc_registrasi.daftar_ol, dbo.tc_registrasi.flag_verif, dbo.tc_registrasi.st_usg, dbo.tc_registrasi.catatan_rm, dbo.tc_registrasi.id_lengkap_erm
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi INNER JOIN
                      dbo.pm_tc_penunjang ON dbo.tc_kunjungan.no_kunjungan = dbo.pm_tc_penunjang.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr
WHERE     (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.pm_tc_penunjang.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pasienpm_v]");
    }
};
