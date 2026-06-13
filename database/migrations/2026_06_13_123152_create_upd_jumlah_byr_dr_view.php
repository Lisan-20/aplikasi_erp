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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_jumlah_byr_dr
AS
SELECT     dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans.tgl_transaksi, dbo.bd_tc_trans.jumlah, dbo.bd_tc_bayar_dr.nominal_bayar, 
                      dbo.bd_tc_trans_detail.jumlah AS jumlah_det
FROM         dbo.bd_tc_trans INNER JOIN
                      dbo.bd_tc_bayar_dr ON dbo.bd_tc_trans.no_bukti = dbo.bd_tc_bayar_dr.no_kutansi_byr INNER JOIN
                      dbo.bd_tc_trans_detail ON dbo.bd_tc_trans.id_bd_tc_trans = dbo.bd_tc_trans_detail.id_bd_tc_trans
WHERE     (dbo.bd_tc_trans.jumlah = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_jumlah_byr_dr]");
    }
};
