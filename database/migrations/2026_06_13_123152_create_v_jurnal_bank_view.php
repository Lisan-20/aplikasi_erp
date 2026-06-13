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
        DB::statement("CREATE OR ALTER VIEW dbo.v_jurnal_bank
AS
SELECT        dbo.v_jurnal.no_urut, dbo.v_jurnal.acc_no, dbo.v_jurnal.tx_nominal, dbo.v_jurnal.tx_uraian, dbo.v_jurnal.tx_tgl, dbo.v_jurnal.tx_jam, dbo.v_jurnal.tx_tipe, dbo.v_jurnal.no_jurnal, dbo.v_jurnal.no_det_jurnal, 
                         dbo.v_jurnal.no_bukti, dbo.v_jurnal.kode_bagian, dbo.v_jurnal.no_induk, dbo.v_jurnal.kel_jurnal, dbo.v_jurnal.no_mr, dbo.v_jurnal.kode_supplier, dbo.v_jurnal.kode_barang, dbo.v_jurnal.kode_bank, 
                         dbo.v_jurnal.flag_k, dbo.v_jurnal.flag_posting, dbo.v_jurnal.sub_ledger, dbo.v_jurnal.tahun, dbo.v_jurnal.referensi, dbo.v_jurnal.kode_rekon, dbo.v_jurnal.tgl_bank, dbo.v_jurnal.acc_nama, dbo.v_jurnal.kode_dr, 
                         dbo.v_jurnal.kode_perusahaan, dbo.v_jurnal.kode_tc_trans_kasir, dbo.v_jurnal.no_registrasi, dbo.v_jurnal.ko_wil, dbo.v_jurnal.flag_rekon, dbo.v_jurnal.user_rekon, dbo.v_jurnal.id_rekon
FROM            dbo.Bank_v INNER JOIN
                         dbo.v_jurnal ON dbo.Bank_v.acc_no = dbo.v_jurnal.acc_no
WHERE        (NOT (dbo.Bank_v.acc_no IN ('1110101', '1110102')))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_jurnal_bank]");
    }
};
