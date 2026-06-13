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
        DB::statement("CREATE VIEW dbo.v_billing_administrasi_ranap
AS
SELECT     no_registrasi, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_rs_jatah) + SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * bill_dr1_jatah) + SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_dr2_jatah) + SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * lain_lain) AS total_billing
FROM         dbo.tc_trans_pelayanan
WHERE     (kode_tc_trans_kasir IS NULL OR
                      kode_tc_trans_kasir = 0) AND (nama_tindakan NOT LIKE '%biaya%administrasi') AND (status_selesai = 2) AND (status_batal IS NULL)
GROUP BY no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_billing_administrasi_ranap]");
    }
};
