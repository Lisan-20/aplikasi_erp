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
        DB::statement("CREATE VIEW dbo.sum_revisi_kuitansi_trans_kasir_v
AS
SELECT     no_registrasi, (SUM(bill_rs) + SUM(bill_dr1) + SUM(bill_dr2) + SUM(lain_lain)) - (SUM(CASE WHEN dis_rs IS NULL THEN 0 ELSE dis_rs END) 
                      + SUM(CASE WHEN dis_dr1 IS NULL THEN 0 ELSE dis_dr1 END) + SUM(CASE WHEN dis_dr2 IS NULL THEN 0 ELSE dis_dr2 END)) AS jml_billing
FROM         dbo.revisi_kuitansi_trans_kasir_v
GROUP BY no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_revisi_kuitansi_trans_kasir_v]");
    }
};
