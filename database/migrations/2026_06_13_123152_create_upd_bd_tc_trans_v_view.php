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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_bd_tc_trans_v
AS
SELECT     TOP (100) PERCENT dbo.bd_tc_trans.flag_tmp, dbo.bd_tc_trans_detail.kd_trans_bendahara, dbo.bd_tc_trans.kd_trans_bendahara AS kd_trans_bendahara_tr, 
                      dbo.bd_tc_trans_detail.jumlah, dbo.bd_tc_trans_detail.no_bukti, dbo.bd_tc_trans_detail.acc_no, dbo.bd_tc_trans_detail.tx_tipe, dbo.bd_tc_trans.id_bd_tc_trans
FROM         dbo.bd_tc_trans_detail INNER JOIN
                      dbo.bd_tc_trans ON dbo.bd_tc_trans_detail.id_bd_tc_trans = dbo.bd_tc_trans.id_bd_tc_trans
WHERE     (dbo.bd_tc_trans.kd_trans_bendahara = 2112)
ORDER BY dbo.bd_tc_trans.id_bd_tc_trans
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_bd_tc_trans_v]");
    }
};
