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
        DB::statement("CREATE OR ALTER VIEW dbo.filter_jurnal_rj_K
AS
SELECT     SUM(tx_nominal) AS K, kode_tc_trans_kasir, no_kuitansi, seri_kuitansi, kode, flag_jurnal
FROM         dbo.trans_sed_v
GROUP BY kode_tc_trans_kasir, no_kuitansi, seri_kuitansi, kode, flag_jurnal
HAVING      (seri_kuitansi IN ('RJ', 'AJ', 'NK')) AND (kode NOT IN (20, 21, 22, 23, 24, 25, 26)) AND (flag_jurnal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [filter_jurnal_rj_K]");
    }
};
