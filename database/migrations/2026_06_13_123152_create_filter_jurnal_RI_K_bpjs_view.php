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
        DB::statement("CREATE OR ALTER VIEW dbo.filter_jurnal_RI_K_bpjs
AS
SELECT     SUM(dbo.tran_sed.tx_nominal) + (CASE WHEN selisih IS NULL THEN 0 ELSE selisih END) AS K, dbo.tran_sed.no_registrasi, 
                      CASE WHEN dbo.filter_jurnal_BPJS_sel.selisih IS NULL THEN 0 ELSE dbo.filter_jurnal_BPJS_sel.selisih END AS selisih
FROM         dbo.tran_sed LEFT OUTER JOIN
                      dbo.filter_jurnal_BPJS_sel ON dbo.tran_sed.no_registrasi = dbo.filter_jurnal_BPJS_sel.no_registrasi
WHERE     (dbo.tran_sed.seri_kuitansi IN ('AI', 'RI')) AND (dbo.tran_sed.kode NOT IN (20, 21, 22, 23, 24, 25, 26, 31, 32)) AND (dbo.tran_sed.kode_kelompok IN (8, 
                      9))
GROUP BY dbo.tran_sed.no_registrasi, dbo.filter_jurnal_BPJS_sel.selisih
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [filter_jurnal_RI_K_bpjs]");
    }
};
