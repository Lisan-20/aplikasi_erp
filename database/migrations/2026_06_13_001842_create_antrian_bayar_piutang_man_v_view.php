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
        DB::statement("CREATE OR ALTER VIEW dbo.antrian_bayar_piutang_man_v
AS
SELECT        a.id_trans_piutang, a.acc_no_1, a.acc_no_2, a.tx_tipe, a.jumlah_transaksi, a.no_bukti, a.tgl_transaksi, a.flag_jurnal, a.keterangan, a.inp_tgl, a.inp_id, a.kode_bagian, a.kode_supplier, a.kode_perusahaan, 
                         a.kode_dr, a.stat, a.stat_id, a.tgl_bayar, a.status_bayar, a.flag_ver, a.tgl_ver, a.flag_tmp, a.flag_modul, a.tgl_tempo, a.jumlah_ppn, a.jumlah_pph, a.total, a.id_bd_tc_trans, CASE WHEN a.diskon IS NULL 
                         THEN 0 ELSE a.diskon END AS diskon, a.id_dd_konfigurasi, a.id_tc_tagih, a.tgl_terima_dokumen, b.nama_perusahaan, CASE WHEN jumlah_bayar IS NULL THEN 0 ELSE jumlah_bayar END AS jumlah_bayar, 
                         a.diskon AS Expr1, CASE WHEN jml_penolakan_piut_man_v.penolakan IS NULL THEN 0 ELSE jml_penolakan_piut_man_v.penolakan END AS penolakan, 
                         CASE WHEN jml_biaya_transfer_piut_man_v.biaya_transfer IS NULL THEN 0 ELSE jml_biaya_transfer_piut_man_v.biaya_transfer END AS biaya_transfer
FROM            dbo.transaksi_piutang AS a INNER JOIN
                         dbo.mt_perusahaan AS b ON a.kode_perusahaan = b.kode_perusahaan LEFT OUTER JOIN
                         dbo.jml_biaya_transfer_piut_man_v ON a.id_bd_tc_trans = dbo.jml_biaya_transfer_piut_man_v.id_bd_tc_trans LEFT OUTER JOIN
                         dbo.jml_penolakan_piut_man_v ON a.id_bd_tc_trans = dbo.jml_penolakan_piut_man_v.id_bd_tc_trans LEFT OUTER JOIN
                         dbo.jml_bayar_piutang_man_v ON a.no_bukti = dbo.jml_bayar_piutang_man_v.no_ref
WHERE        (a.status_bayar IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [antrian_bayar_piutang_man_v]");
    }
};
