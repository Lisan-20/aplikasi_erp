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
        DB::statement("CREATE OR ALTER VIEW dbo.bd_tc_trans_detail_insert
AS
SELECT     id_bd_tc_trans_det, id_bd_tc_trans, kd_group_trans, kd_trans_bendahara, id_bank, giro, tgl_bank, no_bukti, no_ref, tgl_transaksi, penerima, uraian, materai, jumlah, no_induk, user_edit_t, 
                      user_edit_v, online, flag_jurnal, tgl_ver, kode_bagian, kode_suplier, kode_dr, kode_perusahaan, acc_no, tx_tipe, no_urut, status, flag_dr, diskon, flag_kecil
FROM         RSBH_DB.dbo.bd_tc_trans_detail
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bd_tc_trans_detail_insert]");
    }
};
