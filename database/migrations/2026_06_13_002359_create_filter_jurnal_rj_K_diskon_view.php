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
        DB::statement("CREATE OR ALTER VIEW dbo.filter_jurnal_rj_K_diskon
AS
SELECT     SUM(dbo.filter_jurnal_rj_K.K) - (CASE WHEN dbo.filter_jurnal_rj_diskon.diskon IS NULL THEN 0 ELSE dbo.filter_jurnal_rj_diskon.diskon END) AS K, 
                      dbo.filter_jurnal_rj_K.kode_tc_trans_kasir, dbo.filter_jurnal_rj_K.no_kuitansi, dbo.filter_jurnal_rj_K.seri_kuitansi, dbo.filter_jurnal_rj_diskon.diskon, 
                      dbo.filter_jurnal_rj_K.flag_jurnal
FROM         dbo.filter_jurnal_rj_diskon RIGHT OUTER JOIN
                      dbo.filter_jurnal_rj_K ON dbo.filter_jurnal_rj_diskon.kode_tc_trans_kasir = dbo.filter_jurnal_rj_K.kode_tc_trans_kasir
GROUP BY dbo.filter_jurnal_rj_K.kode_tc_trans_kasir, dbo.filter_jurnal_rj_K.no_kuitansi, dbo.filter_jurnal_rj_K.seri_kuitansi, dbo.filter_jurnal_rj_diskon.diskon, 
                      dbo.filter_jurnal_rj_K.flag_jurnal
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [filter_jurnal_rj_K_diskon]");
    }
};
