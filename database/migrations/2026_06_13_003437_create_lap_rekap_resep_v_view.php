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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rekap_resep_v
AS
SELECT     TOP (100) PERCENT COUNT(dbo.lap_rekap_resep_new_v.kode_trans_far) AS jumlah, DAY(dbo.lap_rekap_resep_new_v.tgl_trans) AS tgl, MONTH(dbo.lap_rekap_resep_new_v.tgl_trans) AS bln, 
                      YEAR(dbo.lap_rekap_resep_new_v.tgl_trans) AS thn, CASE WHEN kode_kelompok IS NULL THEN 1 ELSE kode_kelompok END AS nasabah, dbo.lap_rekap_resep_new_v.kode_profit
FROM         dbo.lap_rekap_resep_new_v LEFT OUTER JOIN
                      dbo.tc_registrasi ON dbo.lap_rekap_resep_new_v.no_registrasi = dbo.tc_registrasi.no_registrasi AND dbo.lap_rekap_resep_new_v.no_mr = dbo.tc_registrasi.no_mr
WHERE     (dbo.lap_rekap_resep_new_v.kode_bagian = '060101') AND (dbo.lap_rekap_resep_new_v.status_retur IS NULL) AND (dbo.lap_rekap_resep_new_v.status_transaksi = 1)
GROUP BY DAY(dbo.lap_rekap_resep_new_v.tgl_trans), MONTH(dbo.lap_rekap_resep_new_v.tgl_trans), YEAR(dbo.lap_rekap_resep_new_v.tgl_trans), dbo.lap_rekap_resep_new_v.kode_profit, 
                      CASE WHEN kode_kelompok IS NULL THEN 1 ELSE kode_kelompok END
ORDER BY tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rekap_resep_v]");
    }
};
