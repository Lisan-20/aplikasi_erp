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
        DB::statement("CREATE VIEW dbo.upd_rekon_v
AS
SELECT     TOP (100) PERCENT dbo.v_rekon_2.tx_nominal, dbo.v_rekon_1.tx_nominal AS nominal, dbo.bd_tc_trans_detail.jumlah, dbo.v_rekon_2.no_bukti, 
                      dbo.v_rekon_1.no_bukti AS Expr2, dbo.v_rekon_2.no_jurnal, dbo.v_rekon_2.kel_jurnal
FROM         dbo.v_rekon_1 INNER JOIN
                      dbo.v_rekon_2 ON dbo.v_rekon_1.no_bukti = dbo.v_rekon_2.no_bukti AND dbo.v_rekon_1.kel_jurnal = dbo.v_rekon_2.kel_jurnal AND 
                      dbo.v_rekon_1.no_jurnal = dbo.v_rekon_2.no_jurnal INNER JOIN
                      dbo.bd_tc_trans_detail ON dbo.v_rekon_2.no_jurnal = dbo.bd_tc_trans_detail.id_bd_tc_trans AND 
                      dbo.v_rekon_2.no_bukti = dbo.bd_tc_trans_detail.no_bukti AND dbo.v_rekon_1.acc_no = dbo.bd_tc_trans_detail.acc_no
ORDER BY dbo.v_rekon_2.no_bukti
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_rekon_v]");
    }
};
