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
        DB::statement("CREATE VIEW dbo.filter_jurnal_rj_diskon
AS
SELECT     SUM(tx_nominal) AS diskon, kode_tc_trans_kasir, no_kuitansi, seri_kuitansi
FROM         dbo.tran_sed_diskon_v
GROUP BY kode_tc_trans_kasir, no_kuitansi, seri_kuitansi
HAVING      (seri_kuitansi IN ('RJ', 'AJ', 'NK'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [filter_jurnal_rj_diskon]");
    }
};
