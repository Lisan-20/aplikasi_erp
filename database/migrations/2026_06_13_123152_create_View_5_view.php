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
        DB::statement("CREATE VIEW dbo.View_5
AS
SELECT     TOP (100) PERCENT a.id_trans_hutang, a.acc_no_1, a.acc_no_2, a.tx_tipe, a.jumlah_transaksi, a.no_bukti, a.tgl_transaksi, a.flag_jurnal, a.keterangan, a.inp_tgl, 
                      a.inp_id, a.kode_bagian, a.kode_supplier, a.kode_perusahaan, a.kode_dr, a.stat, a.stat_id, a.tgl_bayar, a.status_bayar, a.flag_ver, a.tgl_ver, a.flag_tmp, a.flag_modul, 
                      a.tgl_tempo, a.jumlah_ppn, a.jumlah_pph, a.total, a.id_bd_tc_trans, a.referensi, a.no_urut, b.namasupplier, SUM(dbo.bd_tc_trans.jumlah) AS jumlah
FROM         dbo.transaksi_hutang AS a LEFT OUTER JOIN
                      dbo.bd_tc_trans ON a.id_trans_hutang = dbo.bd_tc_trans.id_trans_hutang LEFT OUTER JOIN
                      dbo.mt_supplier AS b ON b.kodesupplier = a.kode_supplier
GROUP BY a.id_trans_hutang, a.acc_no_1, a.acc_no_2, a.tx_tipe, a.jumlah_transaksi, a.no_bukti, a.tgl_transaksi, a.flag_jurnal, a.keterangan, a.inp_tgl, a.inp_id, a.kode_bagian, 
                      a.kode_supplier, a.kode_perusahaan, a.kode_dr, a.stat, a.stat_id, a.tgl_bayar, a.status_bayar, a.flag_ver, a.tgl_ver, a.flag_tmp, a.flag_modul, a.tgl_tempo, 
                      a.jumlah_ppn, a.jumlah_pph, a.total, a.id_bd_tc_trans, a.referensi, a.no_urut, b.namasupplier
ORDER BY a.no_bukti DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [View_5]");
    }
};
