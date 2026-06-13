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
        DB::statement("CREATE VIEW dbo.pm_pasienpm_bayar_ERM_v
AS
SELECT     no_mr, kota, nama_pasien, nama_panggilan, nama_kel_pasien, tgl_lhr, tempat_lahir, almt_ttp_pasien, tlp_almt_ttp, jen_kelamin, suku, nama_kel_ter, nama_almt_kel, hubungan_kel, gol_darah, 
                      status_batal, stat_pasien, no_kunjungan, kode_bagian_tujuan, kode_bagian_asal, tgl_masuk, tgl_keluar, status_masuk, status_keluar, status_cito, keterangan, kode_penunjang, tgl_daftar, 
                      kode_bagian, no_antrian, tgl_isihasil, no_foto, dr_pengirim, petugas_input, status_daftar, radiografer, petugas_isihasil, catatan_hasil, status_isihasil, no_induk, kode_perusahaan, no_registrasi, 
                      kode_klas, kode_kelompok, no_hasil_pm, status_bayar, YEAR(tgl_daftar) AS tahun, status_man, noSep, CASE WHEN daftar_ol IS NULL THEN 1 ELSE flag_verif END AS filter_verif_ol, 
                      st_ass_awal_fisio, tgl_jam_fisio, id_user_fisio, st_ass_inv_fisio, st_ass_awal_hemo, st_ass_inv_hemo, st_ass_plk_hemo, st_alergi, st_resum, st_usg, ket_pm, tgl_ver, flag_ver, YEAR(tgl_keluar) 
                      AS Expr1, MONTH(tgl_keluar) AS Expr2, DAY(tgl_keluar) AS Expr3, catatan_rm, id_lengkap_erm
FROM         dbo.pm_pasienpm_v
WHERE     (YEAR(tgl_keluar) = YEAR(GETDATE())) AND (MONTH(tgl_keluar) = MONTH(GETDATE())) AND (DAY(tgl_keluar) = DAY(GETDATE()))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pasienpm_bayar_ERM_v]");
    }
};
