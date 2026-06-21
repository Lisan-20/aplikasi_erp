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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_pm_fis_jmlpas_v
AS
SELECT     TOP (100) PERCENT dbo.lap_kunjungan_fis_temp.opd_luar, dbo.lap_kunjungan_fis_temp.opd_dalam, dbo.lap_kunjungan_fis_temp.ipd, CASE WHEN lap_kunjungan_pm_ipd_v.jml_pas IS NULL 
                      THEN 0 ELSE lap_kunjungan_pm_ipd_v.jml_pas END AS ipd1, CASE WHEN lap_kunjungan_pm_opdDlm_v.jml_pas IS NULL 
                      THEN 0 ELSE lap_kunjungan_pm_opdDlm_v.jml_pas END AS opd_dalam1, CASE WHEN lap_kunjungan_pm_opdLuar_v.jml_pas IS NULL 
                      THEN 0 ELSE lap_kunjungan_pm_opdLuar_v.jml_pas END AS opd_luar1, dbo.lap_kunjungan_fis_temp.tglnya, dbo.lap_kunjungan_fis_temp.blnnya, dbo.lap_kunjungan_fis_temp.thnnya
FROM         dbo.lap_kunjungan_fis_temp LEFT OUTER JOIN
                      dbo.lap_kunjungan_pm_ipd_v RIGHT OUTER JOIN
                      dbo.lap_kunjungan_pm_opdLuar_v ON dbo.lap_kunjungan_pm_ipd_v.kode_bagian = dbo.lap_kunjungan_pm_opdLuar_v.kode_bagian AND 
                      dbo.lap_kunjungan_pm_ipd_v.thn = dbo.lap_kunjungan_pm_opdLuar_v.thn AND dbo.lap_kunjungan_pm_ipd_v.bln = dbo.lap_kunjungan_pm_opdLuar_v.bln AND 
                      dbo.lap_kunjungan_pm_ipd_v.tgl = dbo.lap_kunjungan_pm_opdLuar_v.tgl LEFT OUTER JOIN
                      dbo.lap_kunjungan_pm_opdDlm_v ON dbo.lap_kunjungan_pm_opdLuar_v.tgl = dbo.lap_kunjungan_pm_opdDlm_v.tgl AND 
                      dbo.lap_kunjungan_pm_opdLuar_v.bln = dbo.lap_kunjungan_pm_opdDlm_v.bln AND dbo.lap_kunjungan_pm_opdLuar_v.thn = dbo.lap_kunjungan_pm_opdDlm_v.thn AND 
                      dbo.lap_kunjungan_pm_opdLuar_v.kode_bagian = dbo.lap_kunjungan_pm_opdDlm_v.kode_bagian ON dbo.lap_kunjungan_fis_temp.tglnya = dbo.lap_kunjungan_pm_opdLuar_v.tgl AND 
                      dbo.lap_kunjungan_fis_temp.blnnya = dbo.lap_kunjungan_pm_opdLuar_v.bln AND dbo.lap_kunjungan_fis_temp.thnnya = dbo.lap_kunjungan_pm_opdLuar_v.thn
WHERE     (dbo.lap_kunjungan_pm_opdLuar_v.kode_bagian = '050301')
ORDER BY dbo.lap_kunjungan_fis_temp.tglnya
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_pm_fis_jmlpas_v]");
    }
};
