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
        DB::statement("CREATE OR ALTER VIEW dbo.v_jurnal_KB
AS
SELECT     dbo.bd_tc_trans_detail.id_bd_tc_trans, dbo.bd_tc_trans_detail.kd_group_trans, dbo.bd_tc_trans_detail.kd_trans_bendahara, dbo.bd_tc_trans_detail.id_bank, 
                      dbo.bd_tc_trans_detail.giro, dbo.bd_tc_trans_detail.tgl_bank, dbo.bd_tc_trans_detail.no_bukti, dbo.bd_tc_trans_detail.no_ref AS referensi, 
                      dbo.bd_tc_trans_detail.tgl_transaksi, dbo.bd_tc_trans_detail.penerima, dbo.bd_tc_trans_detail.uraian, dbo.bd_tc_trans_detail.jumlah, 
                      dbo.bd_tc_trans_detail.no_induk, dbo.bd_tc_trans_detail.user_edit_t, dbo.bd_tc_trans_detail.flag_jurnal, dbo.bd_tc_trans_detail.kode_bagian, 
                      dbo.bd_tc_trans_detail.kode_suplier, dbo.bd_tc_trans_detail.acc_no, dbo.bd_tc_trans_detail.tx_tipe, dbo.bd_tc_trans_detail.no_urut, dbo.bd_tc_trans_detail.status, 
                      dbo.v_bank_bd_tc_trans.acc_nama, dbo.bd_tc_trans_detail.tgl_ver, dbo.bd_tc_trans_detail.kode_perusahaan, dbo.bd_tc_trans_detail.kode_dr, 
                      dbo.bd_tc_trans.ko_wil
FROM         dbo.v_bd_tc_trans_cek INNER JOIN
                      dbo.bd_tc_trans_detail ON dbo.v_bd_tc_trans_cek.id_bd_tc_trans = dbo.bd_tc_trans_detail.id_bd_tc_trans INNER JOIN
                      dbo.v_bank_bd_tc_trans ON dbo.bd_tc_trans_detail.id_bank = dbo.v_bank_bd_tc_trans.id_bank INNER JOIN
                      dbo.bd_tc_trans ON dbo.v_bd_tc_trans_cek.id_bd_tc_trans = dbo.bd_tc_trans.id_bd_tc_trans
WHERE     (dbo.bd_tc_trans_detail.jumlah > 0) AND (dbo.bd_tc_trans_detail.tgl_ver IS NOT NULL) AND (dbo.bd_tc_trans_detail.no_bukti <> '') AND 
                      (dbo.bd_tc_trans_detail.no_bukti IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_jurnal_KB]");
    }
};
