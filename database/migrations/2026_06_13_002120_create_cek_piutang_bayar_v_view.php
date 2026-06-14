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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_piutang_bayar_v
AS
SELECT     SUM(dbo.transaksi_piutang.jumlah_transaksi) AS piutang, SUM(dbo.bd_tc_trans.jumlah) AS bayar, dbo.transaksi_piutang.no_bukti
FROM         dbo.bd_tc_trans INNER JOIN
                      dbo.transaksi_piutang ON dbo.bd_tc_trans.no_bukti = dbo.transaksi_piutang.no_bukti AND 
                      dbo.bd_tc_trans.jumlah = dbo.transaksi_piutang.jumlah_transaksi
GROUP BY dbo.transaksi_piutang.no_bukti
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_piutang_bayar_v]");
    }
};
