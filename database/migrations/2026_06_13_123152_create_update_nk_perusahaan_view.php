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
        DB::statement("CREATE OR ALTER VIEW dbo.update_nk_perusahaan
AS
SELECT     SUM(CASE WHEN diskon_rs_jatah IS NULL THEN 0 ELSE diskon_rs_jatah END + CASE WHEN diskon_dr1_jatah IS NULL 
                      THEN 0 ELSE diskon_dr1_jatah END + CASE WHEN diskon_dr2_jatah IS NULL THEN 0 ELSE diskon_dr2_jatah END) AS diskon, 
                      dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.nk_perusahaan, 
                      dbo.tc_trans_kasir.nk_perusahaan - SUM(CASE WHEN diskon_rs_jatah IS NULL 
                      THEN 0 ELSE diskon_rs_jatah END + CASE WHEN diskon_dr1_jatah IS NULL 
                      THEN 0 ELSE diskon_dr1_jatah END + CASE WHEN diskon_dr2_jatah IS NULL THEN 0 ELSE diskon_dr2_jatah END) AS nk_asli, 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_pelayanan.kode_perusahaan = 171)
GROUP BY dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.bill, dbo.tc_trans_kasir.nk_perusahaan, 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_nk_perusahaan]");
    }
};
