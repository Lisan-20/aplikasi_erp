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
        DB::statement("CREATE OR ALTER VIEW dbo.diskon_showa_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.no_registrasi, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * dbo.tc_trans_pelayanan.bill_rs_jatah) AS rs, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr1_jatah) 
                      AS dr1, SUM(dbo.tc_trans_pelayanan.bill_dr2_jatah) AS dr2, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * dbo.tc_trans_pelayanan.lain_lain) AS lain_lain, dbo.tc_trans_pelayanan.status_kredit, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * dbo.tc_trans_pelayanan.diskon_rs_jatah) AS diskon_rs_jatah, SUM(dbo.tc_trans_pelayanan.diskon_dr1_jatah) AS diskon_dr1_jatah, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.diskon_dr2_jatah) AS diskon_dr2_jatah, SUM(CAST((2.50 / 100) 
                      * (((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_rs_jatah + (CASE WHEN status_kredit = 1 THEN (- 1) 
                      ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr1_jatah) + (CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.lain_lain) 
                      AS decimal)) AS diskon_total, dbo.mt_diskon_flat_perusahaan.diskon_rj, dbo.tc_trans_pelayanan.no_mr
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_diskon_flat_perusahaan ON dbo.tc_trans_pelayanan.kode_perusahaan = dbo.mt_diskon_flat_perusahaan.kode_perusahaan
GROUP BY dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.status_batal, 
                      dbo.tc_trans_pelayanan.status_kredit, dbo.mt_diskon_flat_perusahaan.diskon_rj, dbo.tc_trans_pelayanan.no_mr
HAVING      (dbo.tc_trans_pelayanan.kode_perusahaan = 171) AND (dbo.tc_trans_pelayanan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [diskon_showa_v]");
    }
};
