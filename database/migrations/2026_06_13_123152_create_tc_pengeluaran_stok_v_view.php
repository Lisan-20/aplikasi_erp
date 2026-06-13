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
        DB::statement("CREATE VIEW dbo.tc_pengeluaran_stok_v
AS
SELECT     kode_brg, SUM(pemasukan) AS Expr1, SUM(pengeluaran) AS Expr2, jenis_transaksi, tgl_input
FROM         dbo.tc_kartu_stok
GROUP BY kode_brg, jenis_transaksi, tgl_input
HAVING      (SUM(pengeluaran) > 0) AND (NOT (jenis_transaksi IN (20, 9)))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pengeluaran_stok_v]");
    }
};
