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
        DB::statement("CREATE VIEW dbo.jurnal_kuitansi_batal_v
AS
SELECT     dbo.tx_harian.no_urut, dbo.tx_harian.acc_no, dbo.tx_harian.tx_nominal, dbo.tx_harian.tx_uraian, dbo.tx_harian.tx_tgl, dbo.tx_harian.tx_jam, dbo.tx_harian.tx_tipe, 
                      dbo.tx_harian.no_jurnal, dbo.tx_harian.no_det_jurnal, dbo.tx_harian.no_bukti, dbo.tx_harian.kode_bagian, dbo.tx_harian.no_induk, dbo.tx_harian.kel_jurnal, 
                      dbo.tx_harian.no_mr, dbo.tx_harian.no_registrasi, dbo.tx_harian.kode_perusahaan, dbo.tx_harian.kode_tc_trans_kasir, dbo.tx_harian.kode_dr, 
                      dbo.tx_harian.referensi, dbo.tx_harian.flag_b, dbo.tx_harian.kode_barang, dbo.mt_account.acc_nama, dbo.mt_account.sub_ledger
FROM         dbo.tx_harian INNER JOIN
                      dbo.cek_status_batal ON dbo.tx_harian.kode_tc_trans_kasir = dbo.cek_status_batal.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_account ON dbo.tx_harian.acc_no = dbo.mt_account.acc_no
WHERE     (dbo.tx_harian.kel_jurnal IN (1, 2, 3)) AND (YEAR(dbo.tx_harian.tx_tgl) = 2014)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_kuitansi_batal_v]");
    }
};
