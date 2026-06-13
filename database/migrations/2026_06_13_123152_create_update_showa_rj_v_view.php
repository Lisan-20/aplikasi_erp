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
        DB::statement("CREATE VIEW dbo.update_showa_rj_v
AS
SELECT     kode_perusahaan, no_registrasi, status_batal, bill_rs_jatah, bill_dr1_jatah, bill_dr2_jatah, lain_lain, status_kredit, diskon_rs_jatah, diskon_dr1_jatah, 
                      diskon_dr2_jatah, CAST((2.50 / 100) * (bill_rs_jatah + bill_dr1_jatah + lain_lain) AS decimal) AS diskon_total
FROM         dbo.tc_trans_pelayanan
WHERE     (kode_perusahaan = 171) AND (status_batal IS NULL) AND (kode_tc_trans_kasir IN
                          (SELECT     kode_tc_trans_kasir
                            FROM          dbo.tc_trans_kasir
                            WHERE      (seri_kuitansi IN ('AJ', 'RJ')))) AND (no_registrasi IN (18408, 18622, 18621, 18707, 18355, 18994, 19163, 19280, 19353, 19445, 19888, 
                      20043, 20095, 20118, 20220))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_showa_rj_v]");
    }
};
