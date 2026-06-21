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
        DB::statement("CREATE OR ALTER VIEW dbo.ver_fee_dokter_manual_v
AS
SELECT     dbo.bd_tc_trans.id_bd_tc_trans, dbo.bd_tc_trans.kd_group_trans, dbo.bd_tc_trans.kd_trans_bendahara, dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans.tgl_transaksi, 
                      dbo.bd_tc_trans_detail.jumlah, dbo.bd_tc_trans_detail.kode_dr, dbo.bd_tc_trans_detail.flag_dr, dbo.bd_tc_trans.uraian, dbo.bd_tc_trans_detail.id_bd_tc_trans_det, 
                      dbo.bd_tc_trans_detail.acc_no, dbo.bd_tc_trans_detail.kode_bagian
FROM         dbo.bd_tc_trans INNER JOIN
                      dbo.bd_tc_trans_detail ON dbo.bd_tc_trans.id_bd_tc_trans = dbo.bd_tc_trans_detail.id_bd_tc_trans
WHERE     (dbo.bd_tc_trans.kd_group_trans = 1) AND (dbo.bd_tc_trans_detail.kode_dr > '0') AND (dbo.bd_tc_trans_detail.acc_no IN (2110502, 2110503, 2110504, 2110505))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ver_fee_dokter_manual_v]");
    }
};
