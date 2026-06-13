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
        DB::statement("CREATE VIEW dbo.tc_lap_bagian_pm_harian_v
AS
SELECT     YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS thn, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bln, DAY(dbo.tc_trans_pelayanan.tgl_transaksi) 
                      AS tgl, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_mr, dbo.tc_registrasi.stat_pasien, dbo.tc_trans_pelayanan.status_selesai, 
                      dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_kunjungan.status_batal, 
                      dbo.tc_kunjungan.tgl_masuk AS tgl_daftar, dbo.tc_kunjungan.tgl_keluar, dbo.tc_registrasi.umur, dbo.pm_tc_penunjang.dr_pengirim, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_bagian_asal AS Expr1, 
                      dbo.tc_registrasi.status_batal AS Expr2
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.pm_tc_penunjang ON dbo.tc_trans_pelayanan.kode_penunjang = dbo.pm_tc_penunjang.kode_penunjang
WHERE     (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.status_selesai > 0)
GROUP BY YEAR(dbo.tc_trans_pelayanan.tgl_transaksi), MONTH(dbo.tc_trans_pelayanan.tgl_transaksi), DAY(dbo.tc_trans_pelayanan.tgl_transaksi), 
                      dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_mr, dbo.tc_registrasi.stat_pasien, dbo.tc_trans_pelayanan.status_selesai, 
                      dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_kunjungan.status_batal, 
                      dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, dbo.tc_registrasi.umur, dbo.pm_tc_penunjang.dr_pengirim, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.kode_bagian_asal, 
                      dbo.tc_registrasi.status_batal
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_lap_bagian_pm_harian_v]");
    }
};
