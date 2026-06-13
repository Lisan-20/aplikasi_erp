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
        DB::statement("CREATE VIEW dbo.jurnal_debet
AS
SELECT     SUM(tx_nominal) AS Expr1, kode_tc_trans_kasir
FROM         dbo.tx_harian
GROUP BY tx_tipe, kode_tc_trans_kasir
HAVING      (tx_tipe = 'D') AND (kode_tc_trans_kasir > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_debet]");
    }
};
