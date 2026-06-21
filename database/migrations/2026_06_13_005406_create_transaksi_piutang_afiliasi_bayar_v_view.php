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
        DB::statement("CREATE OR ALTER VIEW dbo.transaksi_piutang_afiliasi_bayar_v
AS
SELECT     dbo.transaksi_piutang_afiliasi_bayar.id_trans_piutang_afls, SUM(dbo.transaksi_piutang_afiliasi_bayar.jumlah_bayar) AS jumlah_bayar, dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans.no_ref, 
                      SUM(dbo.bd_tc_trans.jumlah) AS jumlah
FROM         dbo.transaksi_piutang_afiliasi_bayar RIGHT OUTER JOIN
                      dbo.bd_tc_trans ON dbo.transaksi_piutang_afiliasi_bayar.id_bd_tc_trans = dbo.bd_tc_trans.id_bd_tc_trans
GROUP BY dbo.transaksi_piutang_afiliasi_bayar.id_trans_piutang_afls, dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans.no_ref
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [transaksi_piutang_afiliasi_bayar_v]");
    }
};
