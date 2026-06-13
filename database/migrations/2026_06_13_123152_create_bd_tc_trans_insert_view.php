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
        DB::statement("CREATE VIEW dbo.bd_tc_trans_insert
AS
SELECT     id_bd_tc_trans, kd_group_trans, kd_trans_bendahara, id_bank, giro, tgl_bank, no_bukti, no_ref, tgl_transaksi, penerima, uraian, materai, jumlah, no_induk, flag_modul, flag_tmp, flag_jurnal, tgl_ver, 
                      kode_bagian, acc_no, tx_tipe, no_urut, status, detail, stat_id, id_tc_hutang_supplier_inv, id_tc_hutang_supplier_vcr, no_registrasi, id_masal, no_mr, kode_tc_trans_kasir, ko_wil, id_trans_piutang, 
                      id_trans_hutang
FROM         RSBH_DB.dbo.bd_tc_trans
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bd_tc_trans_insert]");
    }
};
