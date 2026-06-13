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
        DB::statement("CREATE VIEW dbo.GRAND_TOTAL_PENDAPATAN_ASURANSI_V
AS
SELECT     dbo.TOTAL_PENDAPATAN_ASURANSI_V.seri_kuitansi, dbo.TOTAL_PENDAPATAN_ASURANSI_V.no_kuitansi, 
                      dbo.TOTAL_PENDAPATAN_ASURANSI_V.bill_rs + dbo.TOTAL_PENDAPATAN_ASURANSI_V.bill_dr1 + dbo.TOTAL_PENDAPATAN_ASURANSI_V.bill_dr2 + dbo.TOTAL_PENDAPATAN_ASURANSI_V.LAIN_LAIN
                       - dbo.TOTAL_PENDAPATAN_ASURANSI_V.diskon_rs - dbo.TOTAL_PENDAPATAN_ASURANSI_V.diskon_dr1 - dbo.TOTAL_PENDAPATAN_ASURANSI_V.diskon_dr2 AS BILLING,
                       dbo.TOTAL_PENERIMAAN_KASIR_V.KASIR, dbo.TOTAL_PENDAPATAN_ASURANSI_V.bill_rs, dbo.TOTAL_PENDAPATAN_ASURANSI_V.bill_dr1, 
                      dbo.TOTAL_PENDAPATAN_ASURANSI_V.bill_dr2, dbo.TOTAL_PENDAPATAN_ASURANSI_V.LAIN_LAIN, dbo.TOTAL_PENDAPATAN_ASURANSI_V.diskon_rs, 
                      dbo.TOTAL_PENDAPATAN_ASURANSI_V.diskon_dr1, dbo.TOTAL_PENDAPATAN_ASURANSI_V.diskon_dr2, dbo.TOTAL_PENERIMAAN_KASIR_V.bulan, 
                      dbo.TOTAL_PENDAPATAN_ASURANSI_V.kode_tc_trans_kasir
FROM         dbo.TOTAL_PENDAPATAN_ASURANSI_V INNER JOIN
                      dbo.TOTAL_PENERIMAAN_KASIR_V ON 
                      dbo.TOTAL_PENDAPATAN_ASURANSI_V.kode_tc_trans_kasir = dbo.TOTAL_PENERIMAAN_KASIR_V.kode_tc_trans_kasir
WHERE     (dbo.TOTAL_PENDAPATAN_ASURANSI_V.seri_kuitansi NOT IN ('RJ', 'AJ', 'NK'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [GRAND_TOTAL_PENDAPATAN_ASURANSI_V]");
    }
};
