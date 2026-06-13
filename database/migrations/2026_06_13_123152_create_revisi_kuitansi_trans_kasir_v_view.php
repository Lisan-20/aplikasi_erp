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
        DB::statement("CREATE VIEW dbo.revisi_kuitansi_trans_kasir_v
AS
SELECT     no_registrasi, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_rs) AS bill_rs, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_dr1) 
                      AS bill_dr1, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_dr2) AS bill_dr2, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * lain_lain)
                       AS lain_lain, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * diskon_rs) AS dis_rs, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * diskon_dr1) AS dis_dr1, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * diskon_dr2) AS dis_dr2
FROM         dbo.tc_trans_pelayanan
WHERE     (1 = 1) AND (status_batal IS NULL)
GROUP BY no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [revisi_kuitansi_trans_kasir_v]");
    }
};
