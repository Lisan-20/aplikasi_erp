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
        DB::statement("CREATE OR ALTER VIEW dbo.jumlah_bill_rj_ver_v
AS
SELECT     SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_rs) + SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_dr1) 
                      + SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_dr2) + SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * lain_lain) AS billing, 
                      kode_tc_trans_kasir, flag_jurnal
FROM         dbo.tc_trans_pelayanan
WHERE     (status_batal IS NULL)
GROUP BY kode_tc_trans_kasir, flag_jurnal
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jumlah_bill_rj_ver_v]");
    }
};
