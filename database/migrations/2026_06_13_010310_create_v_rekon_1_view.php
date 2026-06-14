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
        DB::statement("CREATE OR ALTER VIEW dbo.v_rekon_1
AS
SELECT     TOP (100) PERCENT dbo.tx_harian.no_urut, dbo.tx_harian.acc_no, dbo.tx_harian.tx_nominal, dbo.tx_harian.tx_uraian, dbo.tx_harian.tx_tgl, 
                      dbo.tx_harian.tx_jam, dbo.tx_harian.tx_tipe, dbo.tx_harian.no_jurnal, dbo.tx_harian.no_det_jurnal, dbo.tx_harian.no_bukti, dbo.tx_harian.kode_bagian, 
                      dbo.tx_harian.no_induk, dbo.tx_harian.kel_jurnal, dbo.tx_harian.no_mr, dbo.tx_harian.kode_supplier, dbo.tx_harian.kode_barang, 
                      dbo.tx_harian.kode_bank, dbo.tx_harian.flag_k, dbo.tx_harian.flag_posting, dbo.mt_account.sub_ledger, YEAR(dbo.tx_harian.tx_tgl) AS tahun, 
                      dbo.mt_account.referensi, dbo.tx_harian.kode_rekon, dbo.tx_harian.tgl_bank, dbo.mt_account.acc_nama, dbo.tx_harian.kode_dr, 
                      dbo.tx_harian.kode_perusahaan, dbo.tx_harian.kode_tc_trans_kasir, dbo.tx_harian.no_registrasi, dbo.tx_harian.ko_wil, dbo.tx_harian.flag_rekon, 
                      dbo.tx_harian.user_rekon, dbo.tx_harian.id_rekon
FROM         dbo.tx_harian INNER JOIN
                      dbo.mt_account ON dbo.tx_harian.acc_no = dbo.mt_account.acc_no
WHERE     (dbo.tx_harian.flag_rekon = 1) AND (dbo.tx_harian.tx_nominal = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_rekon_1]");
    }
};
