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
        DB::statement("CREATE OR ALTER VIEW dbo.TOTAL_PENERIMAAN_KASIR_V
AS
SELECT     MONTH(tgl_jam) AS bulan, SUM(CASE WHEN TUNAI IS NULL THEN 0 ELSE TUNAI END) AS TUNAI, SUM(CASE WHEN DEBET IS NULL THEN 0 ELSE DEBET END) 
                      AS DEBET, SUM(CASE WHEN KREDIT IS NULL THEN 0 ELSE KREDIT END) AS KREDIT, SUM(CASE WHEN NK IS NULL THEN 0 ELSE NK END) AS NK, 
                      SUM(CASE WHEN NK_PERUSAHAAN IS NULL THEN 0 ELSE NK_PERUSAHAAN END) AS NK_PERUSAHAAN, SUM(CASE WHEN ND IS NULL THEN 0 ELSE ND END) 
                      AS ND, no_registrasi, kode_tc_trans_kasir, SUM(CASE WHEN TUNAI IS NULL THEN 0 ELSE TUNAI END) + SUM(CASE WHEN DEBET IS NULL 
                      THEN 0 ELSE DEBET END) + SUM(CASE WHEN KREDIT IS NULL THEN 0 ELSE KREDIT END) + SUM(CASE WHEN NK IS NULL THEN 0 ELSE NK END) 
                      + SUM(CASE WHEN NK_PERUSAHAAN IS NULL THEN 0 ELSE NK_PERUSAHAAN END) - SUM(CASE WHEN ND IS NULL THEN 0 ELSE ND END) AS KASIR
FROM         dbo.tc_trans_kasir
WHERE     (status_batal IS NULL) AND (seri_kuitansi <> 'um')
GROUP BY no_registrasi, kode_tc_trans_kasir, MONTH(tgl_jam)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [TOTAL_PENERIMAAN_KASIR_V]");
    }
};
