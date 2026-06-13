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
        DB::statement("CREATE VIEW dbo.v_billing_revisi_kuitansi
AS
SELECT     TOP (100) PERCENT a.tunai, a.nk_perusahaan, a.nk_bpjs, b.jml_billing, b.no_registrasi, a.seri_kuitansi, b.jml_billing - (CASE WHEN a.tunai IS NULL 
                      THEN 0 ELSE a.tunai END) AS billing_nk, a.bill
FROM         dbo.tc_trans_kasir AS a INNER JOIN
                      dbo.sum_revisi_kuitansi_trans_kasir_v AS b ON a.no_registrasi = b.no_registrasi
WHERE     (a.status_batal IS NULL) AND (a.seri_kuitansi IN ('AI', 'AJ')) AND (b.no_registrasi > 0)
ORDER BY b.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_billing_revisi_kuitansi]");
    }
};
