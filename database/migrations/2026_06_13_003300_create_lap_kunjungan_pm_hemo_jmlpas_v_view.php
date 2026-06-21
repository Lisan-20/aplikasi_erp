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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_pm_hemo_jmlpas_v
AS
SELECT     TOP (100) PERCENT dbo.lap_kunjungan_hemo_temp.opd_luar, dbo.lap_kunjungan_hemo_temp.opd_dalam, dbo.lap_kunjungan_hemo_temp.ipd, 
                      CASE WHEN lap_kunjungan_pm_opdLuar_v.jml_pas IS NULL THEN 0 ELSE lap_kunjungan_pm_opdLuar_v.jml_pas END AS opd_luar1, CASE WHEN lap_kunjungan_pm_opdDlm_v.jml_pas IS NULL 
                      THEN 0 ELSE lap_kunjungan_pm_opdDlm_v.jml_pas END AS opd_dalam1, CASE WHEN lap_kunjungan_pm_ipd_v.jml_pas IS NULL THEN 0 ELSE lap_kunjungan_pm_ipd_v.jml_pas END AS ipd1, 
                      dbo.lap_kunjungan_hemo_temp.tglnya, dbo.lap_kunjungan_hemo_temp.blnnya, dbo.lap_kunjungan_hemo_temp.thnnya
FROM         dbo.lap_kunjungan_pm_opdLuar_v RIGHT OUTER JOIN
                      dbo.lap_kunjungan_pm_opdDlm_v RIGHT OUTER JOIN
                      dbo.lap_kunjungan_hemo_temp ON dbo.lap_kunjungan_pm_opdDlm_v.kode_bagian = dbo.lap_kunjungan_hemo_temp.kode_bagian AND 
                      dbo.lap_kunjungan_pm_opdDlm_v.thn = dbo.lap_kunjungan_hemo_temp.thnnya AND dbo.lap_kunjungan_pm_opdDlm_v.bln = dbo.lap_kunjungan_hemo_temp.blnnya AND 
                      dbo.lap_kunjungan_pm_opdDlm_v.tgl = dbo.lap_kunjungan_hemo_temp.tglnya LEFT OUTER JOIN
                      dbo.lap_kunjungan_pm_ipd_v ON dbo.lap_kunjungan_hemo_temp.kode_bagian = dbo.lap_kunjungan_pm_ipd_v.kode_bagian AND 
                      dbo.lap_kunjungan_hemo_temp.thnnya = dbo.lap_kunjungan_pm_ipd_v.thn AND dbo.lap_kunjungan_hemo_temp.blnnya = dbo.lap_kunjungan_pm_ipd_v.bln AND 
                      dbo.lap_kunjungan_hemo_temp.tglnya = dbo.lap_kunjungan_pm_ipd_v.tgl ON dbo.lap_kunjungan_pm_opdLuar_v.kode_bagian = dbo.lap_kunjungan_hemo_temp.kode_bagian AND 
                      dbo.lap_kunjungan_pm_opdLuar_v.tgl = dbo.lap_kunjungan_hemo_temp.tglnya AND dbo.lap_kunjungan_pm_opdLuar_v.bln = dbo.lap_kunjungan_hemo_temp.blnnya AND 
                      dbo.lap_kunjungan_pm_opdLuar_v.thn = dbo.lap_kunjungan_hemo_temp.thnnya
ORDER BY dbo.lap_kunjungan_hemo_temp.tglnya
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_pm_hemo_jmlpas_v]");
    }
};
