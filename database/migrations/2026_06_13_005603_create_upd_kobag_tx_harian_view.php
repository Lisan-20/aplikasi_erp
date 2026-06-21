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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_kobag_tx_harian
AS
SELECT     dbo.transaksi.no_bukti, dbo.tx_harian.no_bukti AS Expr1, dbo.tx_harian.kode_bagian, dbo.transaksi.kode_bagian AS kode_bagian_trans
FROM         dbo.tx_harian INNER JOIN
                      dbo.transaksi ON dbo.tx_harian.no_bukti = dbo.transaksi.no_bukti
WHERE     (dbo.transaksi.no_bukti LIKE '%jan%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kobag_tx_harian]");
    }
};
