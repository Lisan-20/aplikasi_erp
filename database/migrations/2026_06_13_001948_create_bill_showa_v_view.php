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
        DB::statement("CREATE OR ALTER VIEW dbo.bill_showa_v
AS
SELECT     kode_perusahaan, no_registrasi, status_batal, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_rs_jatah) AS bill_rs_jatah, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_dr1_jatah) AS bill_dr1_jatah, SUM(bill_dr2_jatah) AS bill_dr2_jatah, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * lain_lain) AS lain_lain, status_kredit, SUM((CASE WHEN status_kredit = 1 THEN (- 1) 
                      ELSE 1 END) * diskon_rs_jatah) AS diskon_rs_jatah, SUM(diskon_dr1_jatah) AS diskon_dr1_jatah, SUM((CASE WHEN status_kredit = 1 THEN (- 1) 
                      ELSE 1 END) * diskon_dr2_jatah) AS diskon_dr2_jatah, SUM(CAST((2.50 / 100) * (((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * bill_rs_jatah + (CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_dr1_jatah) + (CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * lain_lain) AS decimal)) AS diskon_total, kode_tc_trans_kasir
FROM         dbo.tc_trans_pelayanan
GROUP BY kode_perusahaan, no_registrasi, status_batal, status_kredit, kode_tc_trans_kasir
HAVING      (kode_perusahaan = 171) AND (status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bill_showa_v]");
    }
};
