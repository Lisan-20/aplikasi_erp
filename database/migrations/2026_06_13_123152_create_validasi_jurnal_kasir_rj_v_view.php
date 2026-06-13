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
        DB::statement("CREATE OR ALTER VIEW dbo.validasi_jurnal_kasir_rj_v
AS
SELECT     SUM(jumlah) AS kasir, kode_tc_trans_kasir
FROM         dbo.tran_kasir
GROUP BY kode_tc_trans_kasir, flag_jurnal
HAVING      (flag_jurnal IS NULL) AND (kode_tc_trans_kasir > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [validasi_jurnal_kasir_rj_v]");
    }
};
