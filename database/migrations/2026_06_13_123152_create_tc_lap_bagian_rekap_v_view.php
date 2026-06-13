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
        DB::statement("CREATE VIEW dbo.tc_lap_bagian_rekap_v
AS
SELECT     TOP (100) PERCENT YEAR(dbo.tc_kunjungan.tgl_keluar) AS thn, MONTH(dbo.tc_kunjungan.tgl_keluar) AS bln, DAY(dbo.tc_kunjungan.tgl_keluar) AS tgl, 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.mt_master_pasien.jen_kelamin, COUNT(dbo.mt_master_pasien.jen_kelamin) AS jml_jen_kelamin, 
                      dbo.mt_master_pasien.kode_kelompok, COUNT(dbo.tc_registrasi.kode_kelompok) AS jml_kode_kelompok, dbo.tc_registrasi.stat_pasien, 
                      COUNT(dbo.tc_registrasi.stat_pasien) AS jml_stat_pasien, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_registrasi.umur
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan
GROUP BY DAY(dbo.tc_kunjungan.tgl_keluar), dbo.tc_kunjungan.kode_bagian_tujuan, dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.kode_kelompok, 
                      dbo.tc_registrasi.stat_pasien, MONTH(dbo.tc_kunjungan.tgl_keluar), YEAR(dbo.tc_kunjungan.tgl_keluar), dbo.tc_kunjungan.status_batal, 
                      dbo.tc_trans_pelayanan.status_selesai, dbo.tc_registrasi.umur
HAVING      (DAY(dbo.tc_kunjungan.tgl_keluar) IS NOT NULL) AND (MONTH(dbo.tc_kunjungan.tgl_keluar) IS NOT NULL) AND (YEAR(dbo.tc_kunjungan.tgl_keluar) IS NOT NULL) AND
                       (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.status_selesai > 0)
ORDER BY thn, bln, tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_lap_bagian_rekap_v]");
    }
};
