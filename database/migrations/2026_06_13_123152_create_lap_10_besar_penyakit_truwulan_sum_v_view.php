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
        DB::statement("CREATE VIEW dbo.lap_10_besar_penyakit_truwulan_sum_v
AS
SELECT     TOP (100) PERCENT dbo.lap_10_besar_penyakit_sum_v.tahun, dbo.lap_10_besar_penyakit_sum_v.tipe_rl, SUM(dbo.lap_10_besar_penyakit_sum_v.jumlah) 
                      AS jumlah, dbo.lap_10_besar_penyakit_sum_v.kode_icd, dbo.lap_10_besar_penyakit_sum_v.nama_icd_10, dbo.mt_bulan.triwulan
FROM         dbo.lap_10_besar_penyakit_sum_v INNER JOIN
                      dbo.mt_bulan ON dbo.lap_10_besar_penyakit_sum_v.bulan = dbo.mt_bulan.bulan
GROUP BY dbo.lap_10_besar_penyakit_sum_v.tahun, dbo.lap_10_besar_penyakit_sum_v.tipe_rl, dbo.lap_10_besar_penyakit_sum_v.kode_icd, 
                      dbo.lap_10_besar_penyakit_sum_v.nama_icd_10, dbo.mt_bulan.triwulan
ORDER BY jumlah DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_10_besar_penyakit_truwulan_sum_v]");
    }
};
