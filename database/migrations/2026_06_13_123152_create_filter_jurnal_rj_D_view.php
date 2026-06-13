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
        DB::statement("CREATE VIEW dbo.filter_jurnal_rj_D
AS
SELECT     SUM(jumlah) AS D, kode_tc_trans_kasir, no_kuitansi, seri_kuitansi, flag_jurnal
FROM         dbo.tran_kasir
GROUP BY kode_tc_trans_kasir, no_kuitansi, seri_kuitansi, flag_jurnal
HAVING      (seri_kuitansi IN ('RJ', 'AJ', 'NK')) AND (flag_jurnal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [filter_jurnal_rj_D]");
    }
};
