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
        DB::statement("CREATE OR ALTER VIEW dbo.update_tgl_kui_setor_v
AS
SELECT     dbo.bd_tc_setoran.tgl_transaksi, dbo.bd_tc_setoran.tgl_disetor, dbo.bd_tc_trans.no_bukti, dbo.bd_tc_setoran.no_kuitansi_bendahara, dbo.bd_tc_trans.tgl_transaksi AS Expr1, 
                      dbo.bd_tc_trans_detail.id_bd_tc_trans, dbo.bd_tc_trans_detail.kd_group_trans, dbo.bd_tc_trans_detail.tgl_transaksi AS Expr2, dbo.bd_tc_trans_detail.kd_trans_bendahara
FROM         dbo.bd_tc_trans INNER JOIN
                      dbo.bd_tc_trans_detail ON dbo.bd_tc_trans.id_bd_tc_trans = dbo.bd_tc_trans_detail.id_bd_tc_trans INNER JOIN
                      dbo.bd_tc_setoran ON dbo.bd_tc_trans.tgl_transaksi = dbo.bd_tc_setoran.tgl_disetor AND MONTH(dbo.bd_tc_trans.tgl_transaksi) <> MONTH(dbo.bd_tc_setoran.tgl_transaksi)
WHERE     (dbo.bd_tc_trans_detail.kd_trans_bendahara = 1107)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_tgl_kui_setor_v]");
    }
};
