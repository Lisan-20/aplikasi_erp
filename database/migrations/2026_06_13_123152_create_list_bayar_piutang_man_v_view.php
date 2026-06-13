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
        DB::statement("CREATE OR ALTER VIEW dbo.list_bayar_piutang_man_v
AS
SELECT     a.id_trans_piutang, a.acc_no_1, a.acc_no_2, a.tx_tipe, a.jumlah_transaksi, a.no_bukti, a.tgl_transaksi, a.flag_jurnal, a.keterangan, a.inp_tgl, a.inp_id, a.kode_bagian, a.kode_supplier, 
                      a.kode_perusahaan, a.kode_dr, a.stat, a.stat_id, a.tgl_bayar, a.status_bayar, a.flag_ver, a.tgl_ver, a.flag_tmp, a.flag_modul, a.tgl_tempo, a.jumlah_ppn, a.jumlah_pph, a.total, a.id_bd_tc_trans, 
                      a.diskon, a.id_dd_konfigurasi, a.id_tc_tagih, a.tgl_terima_dokumen, b.nama_perusahaan, dbo.bd_tc_trans.no_bukti AS bukti_bayar, dbo.bd_tc_trans.jumlah AS jumlah_bayar, 
                      dbo.bd_tc_trans.tgl_transaksi AS tgl_pembayaran
FROM         dbo.transaksi_piutang AS a INNER JOIN
                      dbo.mt_perusahaan AS b ON a.kode_perusahaan = b.kode_perusahaan LEFT OUTER JOIN
                      dbo.bd_tc_trans ON a.no_bukti = dbo.bd_tc_trans.no_ref
WHERE     (a.id_tc_tagih = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [list_bayar_piutang_man_v]");
    }
};
