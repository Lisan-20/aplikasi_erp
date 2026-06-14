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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rekap_resep5_v
AS
SELECT     dbo.lap_kunjungan_far_temp.tglnya, dbo.lap_kunjungan_far_temp.blnnya, dbo.lap_kunjungan_far_temp.thnnya, CASE WHEN luar IS NULL THEN 0 ELSE luar END AS luar, 
                      dbo.lap_kunjungan_far_temp.resep_luar, CASE WHEN bebas IS NULL THEN 0 ELSE bebas END AS bebas, dbo.lap_kunjungan_far_temp.obat_bebas, CASE WHEN karyawan IS NULL 
                      THEN 0 ELSE karyawan END AS karyawan, dbo.lap_kunjungan_far_temp.obat_karyawan
FROM         dbo.lap_kunjungan_far_temp LEFT OUTER JOIN
                      dbo.lap_rekap_resep_bebas_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_bebas_v.tgl AND dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_bebas_v.bln AND 
                      dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_bebas_v.thn LEFT OUTER JOIN
                      dbo.lap_rekap_resep_karyawan_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_karyawan_v.tgl AND 
                      dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_karyawan_v.bln AND dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_karyawan_v.thn LEFT OUTER JOIN
                      dbo.lap_rekap_resep_luar_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_luar_v.tgl AND dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_luar_v.bln AND 
                      dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_luar_v.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rekap_resep5_v]");
    }
};
