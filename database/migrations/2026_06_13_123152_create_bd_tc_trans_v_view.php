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
        DB::statement("CREATE OR ALTER VIEW dbo.bd_tc_trans_v
AS
SELECT     dbo.bd_tc_trans.id_bd_tc_trans, dbo.bd_tc_trans.kd_group_trans, dbo.bd_tc_trans.kd_trans_bendahara, dbo.bd_tc_trans_detail.id_bank, dbo.bd_tc_trans_detail.giro, 
                      dbo.bd_tc_trans_detail.tgl_bank, dbo.bd_tc_trans_detail.no_bukti, dbo.bd_tc_trans_detail.no_ref, dbo.bd_tc_trans_detail.tgl_transaksi, 
                      dbo.bd_tc_trans_detail.penerima, dbo.bd_tc_trans_detail.uraian, dbo.bd_tc_trans_detail.materai, dbo.bd_tc_trans_detail.jumlah, dbo.bd_tc_trans_detail.no_induk, 
                      dbo.bd_tc_trans_detail.user_edit_t, dbo.bd_tc_trans_detail.user_edit_v, dbo.bd_tc_trans_detail.online, dbo.bd_tc_trans_detail.flag_jurnal, 
                      dbo.bd_tc_trans_detail.tgl_ver, dbo.bd_tc_trans_detail.kode_bagian, dbo.bd_tc_trans_detail.kode_suplier, dbo.bd_tc_trans_detail.kode_dr, 
                      dbo.bd_tc_trans_detail.kode_perusahaan, dbo.bd_tc_trans_detail.acc_no, dbo.bd_tc_trans_detail.tx_tipe, dbo.bd_tc_trans_detail.no_urut, 
                      dbo.bd_tc_trans_detail.status, dbo.tc_hutang_supplier_vcr.no_voucher, dbo.tc_hutang_supplier_vcr.no_faktur, dbo.mt_supplier.namasupplier
FROM         dbo.bd_tc_trans INNER JOIN
                      dbo.bd_tc_trans_detail ON dbo.bd_tc_trans.id_bd_tc_trans = dbo.bd_tc_trans_detail.id_bd_tc_trans LEFT OUTER JOIN
                      dbo.tc_hutang_supplier_inv ON dbo.bd_tc_trans.id_tc_hutang_supplier_inv = dbo.tc_hutang_supplier_inv.id_tc_hutang_supplier_inv LEFT OUTER JOIN
                      dbo.tc_hutang_supplier_vcr ON dbo.bd_tc_trans.id_tc_hutang_supplier_vcr = dbo.tc_hutang_supplier_vcr.id_tc_hutang_supplier_vcr LEFT OUTER JOIN
                      dbo.mt_supplier ON dbo.bd_tc_trans_detail.kode_suplier = dbo.mt_supplier.kodesupplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bd_tc_trans_v]");
    }
};
