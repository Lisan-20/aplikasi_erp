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
        DB::statement("CREATE OR ALTER VIEW dbo.v_ver_bd_tc_trans
AS
SELECT     dbo.bd_tc_trans_detail.flag_jurnal, dbo.bd_tc_trans_detail.id_bd_tc_trans_det, dbo.bd_tc_trans.id_bd_tc_trans, dbo.bd_tc_trans_detail.kd_group_trans, dbo.bd_tc_trans_detail.kd_trans_bendahara, 
                      dbo.bd_tc_trans_detail.id_bank, dbo.bd_tc_trans_detail.giro, dbo.bd_tc_trans_detail.no_bukti, dbo.bd_tc_trans_detail.penerima, dbo.bd_tc_trans_detail.uraian, dbo.bd_tc_trans_detail.materai, 
                      dbo.bd_tc_trans_detail.jumlah, dbo.bd_tc_trans_detail.no_induk, dbo.bd_tc_trans_detail.tgl_ver, dbo.bd_tc_trans_detail.kode_suplier, dbo.bd_tc_trans_detail.kode_dr, 
                      dbo.bd_tc_trans_detail.kode_perusahaan, dbo.bd_tc_trans_detail.acc_no, dbo.bd_tc_trans_detail.tx_tipe, dbo.bd_tc_trans_detail.no_urut, dbo.bd_tc_trans_detail.status, dbo.bd_tc_trans.flag_tmp, 
                      dbo.bd_tc_trans_detail.user_edit_t, dbo.bd_tc_trans_detail.user_edit_v, dbo.bd_tc_trans_detail.no_ref, dbo.bd_tc_trans.tgl_transaksi, dbo.bd_tc_trans.flag_jurnal AS flag_jurnal_induk, 
                      dbo.mt_account.acc_nama, dbo.bd_tc_trans.kode_bagian
FROM         dbo.bd_tc_trans INNER JOIN
                      dbo.bd_tc_trans_detail ON dbo.bd_tc_trans.id_bd_tc_trans = dbo.bd_tc_trans_detail.id_bd_tc_trans INNER JOIN
                      dbo.mt_account ON dbo.bd_tc_trans_detail.acc_no = dbo.mt_account.acc_no COLLATE Latin1_General_CI_AS INNER JOIN
                      dbo.bd_tc_trans_balance ON dbo.bd_tc_trans.id_bd_tc_trans = dbo.bd_tc_trans_balance.id_bd_tc_trans
WHERE     (dbo.bd_tc_trans_detail.flag_jurnal = 0) AND (dbo.bd_tc_trans.flag_tmp = 0) AND (dbo.bd_tc_trans.id_bd_tc_trans IN
                          (SELECT     dbo.bd_tc_trans.id_bd_tc_trans
                            FROM          dbo.cek_KB_cek AS cek_KB_cek_1)) AND (dbo.bd_tc_trans_detail.kd_group_trans <> 1107)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_ver_bd_tc_trans]");
    }
};
