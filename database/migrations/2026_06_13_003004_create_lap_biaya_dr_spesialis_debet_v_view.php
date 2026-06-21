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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_biaya_dr_spesialis_debet_v
AS
SELECT     SUM(CASE WHEN tx_nominal IS NULL THEN 0 ELSE tx_nominal END) AS debet, MONTH(dbo.tx_harian.tx_tgl) AS bulan, YEAR(dbo.tx_harian.tx_tgl) AS tahun, 
                      dbo.tx_harian.tx_tipe, dbo.mt_karyawan.kode_spesialisasi, dbo.bd_tc_hutang_dr.rj_ri
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.tx_harian ON dbo.mt_karyawan.kode_dokter = dbo.tx_harian.kode_dr INNER JOIN
                      dbo.bd_tc_hutang_dr ON dbo.tx_harian.no_bukti = dbo.bd_tc_hutang_dr.no_bukti AND dbo.tx_harian.kode_dr = dbo.bd_tc_hutang_dr.kode_dokter
GROUP BY MONTH(dbo.tx_harian.tx_tgl), YEAR(dbo.tx_harian.tx_tgl), dbo.tx_harian.tx_tipe, dbo.mt_karyawan.kode_spesialisasi, dbo.bd_tc_hutang_dr.rj_ri
HAVING      (dbo.tx_harian.tx_tipe = 'D') AND (dbo.mt_karyawan.kode_spesialisasi <> 1) AND (dbo.bd_tc_hutang_dr.rj_ri = 'RI')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_biaya_dr_spesialis_debet_v]");
    }
};
