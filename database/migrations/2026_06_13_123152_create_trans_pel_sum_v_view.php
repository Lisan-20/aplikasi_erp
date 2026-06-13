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
        DB::statement("CREATE VIEW dbo.trans_pel_sum_v
AS
SELECT     SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_rs) AS bill_rs, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_dr1) AS bill_dr1, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_dr2) AS bill_dr2, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * lain_lain) AS lain_lain, MAX(kode_trans_pelayanan) 
                      AS kode_trans_pelayanan, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_rs_jatah) AS bill_rs_jatah, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_dr1_jatah) 
                      AS bill_dr1_jatah, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_dr2_jatah) AS bill_dr2_jatah, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * diskon_rs) 
                      AS diskon_rs, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * diskon_dr1) AS diskon_dr1, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * diskon_dr2) AS diskon_dr2, 
                      no_registrasi, no_mr, kode_tc_trans_kasir, status_selesai, status_batal, kode_trans_far
FROM         dbo.tc_trans_pelayanan
GROUP BY no_registrasi, no_mr, kode_tc_trans_kasir, status_selesai, status_batal, kode_trans_far
HAVING      (kode_tc_trans_kasir IS NULL OR
                      kode_tc_trans_kasir = 0) AND (status_selesai = 2) AND (status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [trans_pel_sum_v]");
    }
};
