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
        DB::statement("CREATE OR ALTER VIEW dbo.transaksi_hutang2_v
AS
SELECT     TOP (100) PERCENT a.id_trans_hutang, a.acc_no_1, a.acc_no_2, a.tx_tipe, a.jumlah_transaksi, a.no_bukti, a.tgl_transaksi, a.flag_jurnal, a.keterangan, a.inp_tgl, 
                      a.inp_id, a.kode_bagian, a.kode_supplier, a.kode_perusahaan, a.kode_dr, a.stat, a.stat_id, a.tgl_bayar, a.status_bayar, a.flag_ver, a.tgl_ver, a.flag_tmp, a.flag_modul, 
                      a.tgl_tempo, a.jumlah_ppn, a.jumlah_pph, a.total, a.id_bd_tc_trans, a.referensi, a.no_urut, b.namasupplier, dbo.bd_tc_trans.jumlah, 
                      dbo.bd_tc_trans.id_trans_hutang AS hutang_trans
FROM         dbo.transaksi_hutang AS a LEFT OUTER JOIN
                      dbo.bd_tc_trans ON a.id_bd_tc_trans = dbo.bd_tc_trans.id_bd_tc_trans LEFT OUTER JOIN
                      dbo.mt_supplier AS b ON b.kodesupplier = a.kode_supplier
WHERE     (a.status_bayar = 1)
ORDER BY a.no_bukti DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [transaksi_hutang2_v]");
    }
};
