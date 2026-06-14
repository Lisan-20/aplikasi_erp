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
        DB::statement("CREATE OR ALTER VIEW dbo.satu_v
AS
SELECT       row_number() over (order by bd_tc_trans.id_bd_tc_trans)  AS No,dbo.bd_tc_trans.id_bd_tc_trans, dbo.bd_tc_trans.kd_group_trans, dbo.bd_tc_trans.kd_trans_bendahara, dbo.bd_tc_trans.id_bank, dbo.bd_tc_trans.giro, dbo.bd_tc_trans.tgl_bank, 
                      dbo.bd_tc_trans.no_bukti, dbo.bd_tc_trans.no_ref, dbo.bd_tc_trans.tgl_transaksi, dbo.bd_tc_trans.penerima, dbo.bd_tc_trans.uraian, dbo.bd_tc_trans.materai, dbo.bd_tc_trans.jumlah, 
                      dbo.bd_tc_trans.no_induk, dbo.bd_tc_trans.flag_modul, dbo.bd_tc_trans.flag_tmp, dbo.bd_tc_trans.flag_jurnal, dbo.bd_tc_trans.tgl_ver, dbo.bd_tc_trans.kode_bagian, dbo.bd_tc_trans.acc_no, 
                      dbo.bd_tc_trans.tx_tipe, dbo.bd_tc_trans.no_urut, dbo.bd_tc_trans.status, dbo.bd_tc_trans.detail, dbo.bd_tc_trans.stat_id, dbo.bd_tc_trans.id_tc_hutang_supplier_inv, 
                      dbo.bd_tc_trans.id_tc_hutang_supplier_vcr, dbo.bd_tc_trans.no_registrasi, dbo.bd_tc_trans.id_masal, dbo.bd_tc_trans.no_mr, dbo.bd_tc_trans.kode_tc_trans_kasir, dbo.bd_tc_trans.ko_wil, 
                      dbo.bd_tc_trans.id_trans_piutang, dbo.bd_tc_trans.id_trans_hutang, dbo.bd_tc_trans_detail.no_bukti AS Expr1, dbo.bd_tc_trans_detail.no_ref AS Expr2, 'bll' AS bk
FROM         dbo.bd_tc_trans INNER JOIN
                      dbo.bd_tc_trans_detail ON dbo.bd_tc_trans.id_bd_tc_trans = dbo.bd_tc_trans_detail.id_bd_tc_trans
WHERE     (dbo.bd_tc_trans_detail.no_bukti LIKE '%bll%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [satu_v]");
    }
};
