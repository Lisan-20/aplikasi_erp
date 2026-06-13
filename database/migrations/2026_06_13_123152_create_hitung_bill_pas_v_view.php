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
        DB::statement("CREATE OR ALTER VIEW dbo.hitung_bill_pas_v
AS
SELECT     no_registrasi, SUM(bill_dr1) AS biaya_dokter, SUM(bill_dr1_jatah) AS biaya_dokter_jatah, SUM(bill_dr2) AS biaya_dokter_2, SUM(bill_dr2_jatah) AS biaya_dokter_jatah_2, SUM(bill_rs) AS biaya_rs, 
                      SUM(bill_rs_jatah) AS biaya_rs_jatah
FROM         dbo.tc_trans_pelayanan
GROUP BY no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hitung_bill_pas_v]");
    }
};
