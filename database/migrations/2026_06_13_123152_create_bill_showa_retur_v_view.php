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
        DB::statement("CREATE OR ALTER VIEW dbo.bill_showa_retur_v
AS
SELECT     kode_perusahaan, no_registrasi, status_batal, SUM(bill_rs_jatah) AS bill_rs_jatah, SUM(bill_dr1_jatah) AS bill_dr1_jatah, SUM(bill_dr2_jatah) AS bill_dr2_jatah, SUM(lain_lain) AS lain_lain, 
                      status_kredit, SUM(diskon_rs_jatah) AS diskon_rs_jatah, SUM(diskon_dr1_jatah) AS diskon_dr1_jatah, SUM(diskon_dr2_jatah) AS diskon_dr2_jatah, SUM(CAST((2.50 / 100) 
                      * (bill_rs_jatah + bill_dr1_jatah + lain_lain) AS money)) AS diskon_total, kode_tc_trans_kasir
FROM         dbo.tc_trans_pelayanan
GROUP BY kode_perusahaan, no_registrasi, status_batal, status_kredit, kode_tc_trans_kasir
HAVING      (kode_perusahaan = 171) AND (status_batal IS NULL) AND (status_kredit = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bill_showa_retur_v]");
    }
};
