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
        DB::statement("CREATE VIEW dbo.TOTAL_PENDAPATAN_KASIR_DAN_UM_V
AS
SELECT     SUM(CASE WHEN tunai IS NULL THEN 0 ELSE tunai END) + SUM(CASE WHEN debet IS NULL THEN 0 ELSE debet END) + SUM(CASE WHEN kredit IS NULL 
                      THEN 0 ELSE kredit END) + SUM(CASE WHEN nk IS NULL THEN 0 ELSE nk END) + SUM(CASE WHEN nk_perusahaan IS NULL THEN 0 ELSE nk_perusahaan END) 
                      + SUM(CASE WHEN um IS NULL THEN 0 ELSE um END) - SUM(CASE WHEN nd IS NULL THEN 0 ELSE nd END) AS kasir, 
                      dbo.TOTAL_PENERIMAAN_KASIR_V.no_registrasi, dbo.TOTAL_PENERIMAAN_KASIR_V.bulan
FROM         dbo.TOTAL_PENDAPATAN_UM_V RIGHT OUTER JOIN
                      dbo.TOTAL_PENERIMAAN_KASIR_V ON dbo.TOTAL_PENDAPATAN_UM_V.no_registrasi = dbo.TOTAL_PENERIMAAN_KASIR_V.no_registrasi
GROUP BY dbo.TOTAL_PENERIMAAN_KASIR_V.no_registrasi, dbo.TOTAL_PENERIMAAN_KASIR_V.bulan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [TOTAL_PENDAPATAN_KASIR_DAN_UM_V]");
    }
};
