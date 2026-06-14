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
        DB::statement("CREATE OR ALTER VIEW dbo.GRAND_TOTAL_PENDAPATAN_PASIEN_NON_ASURANSI_V
AS
SELECT     dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.seri_kuitansi, dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.no_kuitansi, 
                      dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.bill_rs + dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.bill_dr1 + dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.bill_dr2 +
                       dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.LAIN_LAIN - dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.diskon_rs - dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.diskon_dr1
                       - dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.diskon_dr2 AS billing, dbo.TOTAL_PENERIMAAN_KASIR_V.KASIR, 
                      (CASE WHEN dbo.TOTAL_PENDAPATAN_UM_V.um IS NULL THEN 0 ELSE dbo.TOTAL_PENDAPATAN_UM_V.um END) AS UM, 
                      dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.bill_rs, dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.bill_dr1, dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.bill_dr2, 
                      dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.LAIN_LAIN, dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.diskon_rs, 
                      dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.diskon_dr1, dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.diskon_dr2, 
                      dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.bulan
FROM         dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V INNER JOIN
                      dbo.TOTAL_PENERIMAAN_KASIR_V ON 
                      dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.kode_tc_trans_kasir = dbo.TOTAL_PENERIMAAN_KASIR_V.kode_tc_trans_kasir LEFT OUTER JOIN
                      dbo.TOTAL_PENDAPATAN_UM_V ON dbo.TOTAL_PENERIMAAN_KASIR_V.no_registrasi = dbo.TOTAL_PENDAPATAN_UM_V.no_registrasi
WHERE     (dbo.TOTAL_PENDAPATAN_NON_ASURANSI_V.seri_kuitansi IN ('AJ', 'RJ', 'NK'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [GRAND_TOTAL_PENDAPATAN_PASIEN_NON_ASURANSI_V]");
    }
};
