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
        DB::statement("CREATE VIEW dbo.v_cek_billing_nk
AS
SELECT     SUM(bill_rs_jatah) AS bill_rs_jatah, SUM(bill_dr1_jatah) AS bill_dr1_jatah, kode_tc_trans_kasir, no_registrasi, SUM(bill_dr2_jatah) AS bill_dr2_jatah, 
                      SUM(bill_rs_jatah + bill_dr1_jatah + bill_dr2_jatah) AS billing
FROM         dbo.tc_trans_pelayanan
GROUP BY kode_tc_trans_kasir, no_registrasi
HAVING      (kode_tc_trans_kasir > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_cek_billing_nk]");
    }
};
