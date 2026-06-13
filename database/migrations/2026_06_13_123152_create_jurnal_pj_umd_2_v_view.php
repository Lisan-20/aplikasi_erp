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
        DB::statement("CREATE VIEW dbo.jurnal_pj_umd_2_v
AS
SELECT     dbo.transaksi_pj_umd.id_trans_pj_umd, dbo.transaksi_pj_umd.id_bd_tc_trans, dbo.transaksi_pj_umd.acc_no_1, dbo.transaksi_pj_umd.acc_no_2, 
                      dbo.transaksi_pj_umd.tx_tipe, dbo.transaksi_pj_umd.jumlah_transaksi, dbo.transaksi_pj_umd.jumlah_umd, dbo.transaksi_pj_umd.selisih, 
                      dbo.transaksi_pj_umd.no_bukti, dbo.transaksi_pj_umd.tgl_transaksi, dbo.transaksi_pj_umd.flag_jurnal, dbo.transaksi_pj_umd.inp_tgl, dbo.transaksi_pj_umd.inp_id, 
                      dbo.transaksi_pj_umd.referensi, dbo.transaksi_pj_umd.flag_ver, dbo.transaksi_pj_umd.tgl_ver, dbo.transaksi_umd.kode_bagian, dbo.transaksi_umd.kode_supplier, 
                      dbo.transaksi_umd.kode_perusahaan, dbo.transaksi_umd.kode_dr, dbo.transaksi_pj_umd.keterangan, dbo.transaksi_umd.tgl_transaksi AS tgl_umd
FROM         dbo.transaksi_pj_umd INNER JOIN
                      dbo.transaksi_umd ON dbo.transaksi_pj_umd.no_bukti = dbo.transaksi_umd.no_bukti
WHERE     (dbo.transaksi_pj_umd.tgl_ver IS NOT NULL) AND (dbo.transaksi_pj_umd.selisih = 0) AND (dbo.transaksi_pj_umd.acc_no_2 IS NOT NULL) AND 
                      (dbo.transaksi_pj_umd.acc_no_1 IS NOT NULL) AND (dbo.transaksi_pj_umd.flag_ver = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_pj_umd_2_v]");
    }
};
