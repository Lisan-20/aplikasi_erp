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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_pasienrad_bayar_v
AS
SELECT     dbo.tc_trans_pelayanan_pm_v.status_selesai_bayar, dbo.pm_pasienpm_v.no_mr, dbo.pm_pasienpm_v.kota, dbo.pm_pasienpm_v.nama_pasien, 
                      dbo.pm_pasienpm_v.nama_panggilan, dbo.pm_pasienpm_v.nama_kel_pasien, dbo.pm_pasienpm_v.tgl_lhr, dbo.pm_pasienpm_v.tempat_lahir, 
                      dbo.pm_pasienpm_v.almt_ttp_pasien, dbo.pm_pasienpm_v.tlp_almt_ttp, dbo.pm_pasienpm_v.jen_kelamin, dbo.pm_pasienpm_v.suku, 
                      dbo.pm_pasienpm_v.nama_kel_ter, dbo.pm_pasienpm_v.nama_almt_kel, dbo.pm_pasienpm_v.hubungan_kel, dbo.pm_pasienpm_v.gol_darah, 
                      dbo.pm_pasienpm_v.status_batal, dbo.pm_pasienpm_v.stat_pasien, dbo.pm_pasienpm_v.no_kunjungan, dbo.pm_pasienpm_v.kode_bagian_tujuan, 
                      dbo.pm_pasienpm_v.kode_bagian_asal, dbo.pm_pasienpm_v.tgl_masuk, dbo.pm_pasienpm_v.tgl_keluar, dbo.pm_pasienpm_v.status_masuk, 
                      dbo.pm_pasienpm_v.status_keluar, dbo.pm_pasienpm_v.status_cito, dbo.pm_pasienpm_v.keterangan, dbo.pm_pasienpm_v.kode_penunjang, 
                      dbo.pm_pasienpm_v.tgl_daftar, dbo.pm_pasienpm_v.kode_bagian, dbo.pm_pasienpm_v.no_antrian, dbo.pm_pasienpm_v.tgl_isihasil, dbo.pm_pasienpm_v.no_foto, 
                      dbo.pm_pasienpm_v.dr_pengirim, dbo.pm_pasienpm_v.petugas_input, dbo.pm_pasienpm_v.status_daftar, dbo.pm_pasienpm_v.radiografer, 
                      dbo.pm_pasienpm_v.petugas_isihasil, dbo.pm_pasienpm_v.catatan_hasil, dbo.pm_pasienpm_v.status_isihasil, dbo.pm_pasienpm_v.no_induk, 
                      dbo.pm_pasienpm_v.kode_perusahaan, dbo.pm_pasienpm_v.no_registrasi, dbo.pm_pasienpm_v.kode_klas, dbo.pm_pasienpm_v.kode_kelompok, 
                      dbo.pm_pasienpm_v.no_hasil_pm, dbo.pm_pasienpm_v.status_bayar, YEAR(dbo.pm_pasienpm_v.tgl_daftar) AS tahun, dbo.pm_pasienpm_v.status_man
FROM         dbo.pm_pasienpm_v LEFT OUTER JOIN
                      dbo.tc_trans_pelayanan_pm_v ON dbo.pm_pasienpm_v.kode_penunjang = dbo.tc_trans_pelayanan_pm_v.kode_penunjang
WHERE     (dbo.pm_pasienpm_v.kode_bagian = '050201')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pasienrad_bayar_v]");
    }
};
