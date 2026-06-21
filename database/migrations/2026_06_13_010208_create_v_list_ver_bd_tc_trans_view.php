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
        DB::statement("CREATE OR ALTER VIEW dbo.v_list_ver_bd_tc_trans
AS
SELECT     TOP (100) PERCENT dbo.bd_tc_trans_detail.flag_jurnal, dbo.bd_tc_trans_detail.id_bd_tc_trans_det, dbo.bd_tc_trans_detail.id_bd_tc_trans, dbo.bd_tc_trans_detail.kd_group_trans, 
                      dbo.bd_tc_trans_detail.kd_trans_bendahara, dbo.bd_tc_trans_detail.id_bank, dbo.bd_tc_trans_detail.giro, dbo.bd_tc_trans_detail.no_bukti, dbo.bd_tc_trans_detail.penerima, 
                      dbo.bd_tc_trans_detail.uraian, dbo.bd_tc_trans_detail.materai, dbo.bd_tc_trans_detail.jumlah, dbo.bd_tc_trans_detail.no_induk, dbo.bd_tc_trans_detail.tgl_ver, dbo.bd_tc_trans_detail.kode_bagian, 
                      dbo.bd_tc_trans_detail.kode_suplier, dbo.bd_tc_trans_detail.kode_dr, dbo.bd_tc_trans_detail.kode_perusahaan, dbo.bd_tc_trans_detail.acc_no, dbo.bd_tc_trans_detail.tx_tipe, 
                      dbo.bd_tc_trans_detail.no_urut, dbo.bd_tc_trans_detail.status, dbo.bd_tc_trans.flag_tmp, dbo.group_trans_bendahara.nama_group, dbo.bd_tc_trans_detail.user_edit_t, 
                      dbo.bd_tc_trans_detail.user_edit_v, dbo.bd_tc_trans_detail.no_ref, dbo.bd_tc_trans.tgl_transaksi, YEAR(dbo.bd_tc_trans.tgl_transaksi) AS Expr1
FROM         dbo.bd_tc_trans INNER JOIN
                      dbo.bd_tc_trans_detail ON dbo.bd_tc_trans.id_bd_tc_trans = dbo.bd_tc_trans_detail.id_bd_tc_trans LEFT OUTER JOIN
                      dbo.Bank_v ON dbo.bd_tc_trans_detail.id_bank = dbo.Bank_v.id_bank LEFT OUTER JOIN
                      dbo.group_trans_bendahara ON dbo.bd_tc_trans_detail.kd_group_trans = dbo.group_trans_bendahara.kd_group_trans
WHERE     (dbo.bd_tc_trans_detail.tgl_ver IS NOT NULL) AND (dbo.bd_tc_trans.flag_tmp = 0) AND (YEAR(dbo.bd_tc_trans.tgl_transaksi) >= 2021)
ORDER BY dbo.bd_tc_trans_detail.id_bd_tc_trans
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_list_ver_bd_tc_trans]");
    }
};
