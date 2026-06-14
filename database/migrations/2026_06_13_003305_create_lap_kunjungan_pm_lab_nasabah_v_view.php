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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_pm_lab_nasabah_v
AS
SELECT     TOP (100) PERCENT CASE WHEN dbo.lap_kunjungan_pm_umum_v.umum IS NULL THEN 0 ELSE dbo.lap_kunjungan_pm_umum_v.umum END AS umum, dbo.lap_kunjungan_lab_temp.tglnya, 
                      dbo.lap_kunjungan_lab_temp.blnnya, dbo.lap_kunjungan_lab_temp.thnnya, dbo.lap_kunjungan_lab_temp.kode_bagian, dbo.lap_kunjungan_lab_temp.umum AS umum1
FROM         dbo.lap_kunjungan_lab_temp LEFT OUTER JOIN
                      dbo.lap_kunjungan_pm_umum_v ON dbo.lap_kunjungan_lab_temp.kode_bagian = dbo.lap_kunjungan_pm_umum_v.kode_bagian AND 
                      dbo.lap_kunjungan_lab_temp.tglnya = dbo.lap_kunjungan_pm_umum_v.tgl AND dbo.lap_kunjungan_lab_temp.blnnya = dbo.lap_kunjungan_pm_umum_v.bln AND 
                      dbo.lap_kunjungan_lab_temp.thnnya = dbo.lap_kunjungan_pm_umum_v.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_pm_lab_nasabah_v]");
    }
};
