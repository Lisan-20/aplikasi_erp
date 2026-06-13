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
        DB::statement("CREATE VIEW dbo.tc_lap_bagian_pm_rekap_v
AS
SELECT DISTINCT 
                      TOP (100) PERCENT YEAR(dbo.tc_kunjungan.tgl_keluar) AS thn, MONTH(dbo.tc_kunjungan.tgl_keluar) AS bln, DAY(dbo.tc_kunjungan.tgl_keluar) AS tgl, 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_registrasi.stat_pasien, dbo.tc_kunjungan.no_mr, dbo.tc_trans_pelayanan.status_selesai, 
                      dbo.tc_kunjungan.no_kunjungan
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_trans_pelayanan.no_kunjungan AND 
                      dbo.tc_registrasi.no_registrasi = dbo.tc_trans_pelayanan.no_registrasi
GROUP BY DAY(dbo.tc_kunjungan.tgl_keluar), dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_registrasi.stat_pasien, MONTH(dbo.tc_kunjungan.tgl_keluar), 
                      YEAR(dbo.tc_kunjungan.tgl_keluar), dbo.tc_kunjungan.status_batal, dbo.tc_kunjungan.no_mr, SUBSTRING(dbo.tc_kunjungan.kode_bagian_asal, 1, 2), 
                      dbo.tc_trans_pelayanan.status_selesai, dbo.tc_kunjungan.no_kunjungan
HAVING      (DAY(dbo.tc_kunjungan.tgl_keluar) IS NOT NULL) AND (MONTH(dbo.tc_kunjungan.tgl_keluar) IS NOT NULL) AND (YEAR(dbo.tc_kunjungan.tgl_keluar) IS NOT NULL) AND
                       (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_kunjungan.kode_bagian_tujuan LIKE '05%') AND (dbo.tc_trans_pelayanan.status_selesai >= 2)
ORDER BY thn, bln, tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_lap_bagian_pm_rekap_v]");
    }
};
