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
        DB::statement("CREATE VIEW dbo.transaksi_sppu_2_v
AS
SELECT     dbo.transaksi_sppu.id_trans_sppu, dbo.transaksi_sppu.acc_no_1, dbo.transaksi_sppu.acc_no_2, dbo.transaksi_sppu.tx_tipe, dbo.transaksi_sppu.jumlah_transaksi, 
                      dbo.transaksi_sppu.no_bukti, dbo.transaksi_sppu.tgl_transaksi, dbo.transaksi_sppu.flag_jurnal, dbo.transaksi_sppu.keterangan, dbo.transaksi_sppu.inp_tgl, 
                      dbo.transaksi_sppu.inp_id, dbo.transaksi_sppu.kode_bagian, dbo.transaksi_sppu.kode_supplier, dbo.transaksi_sppu.kode_perusahaan, 
                      dbo.transaksi_sppu.referensi, dbo.transaksi_sppu.kode_dr, dbo.transaksi_sppu.stat, dbo.transaksi_sppu.stat_id, dbo.transaksi_sppu.tgl_eod, 
                      dbo.transaksi_sppu.flag_ver, dbo.transaksi_sppu.tgl_ver, dbo.transaksi_sppu.tgl_tempo, dbo.transaksi_sppu.jumlah_ppn, dbo.transaksi_sppu.jumlah_pph, 
                      dbo.transaksi_sppu.total, dbo.transaksi_sppu.status_bayar, dbo.transaksi_sppu.tgl_bayar, dbo.transaksi_sppu.kd_trans_bendahara, dbo.transaksi_sppu.ver_id, 
                      dbo.transaksi_sppu.ket, dbo.transaksi_sppu.per_jumlah, dbo.mt_account.acc_no_rs, dbo.mt_account.acc_nama
FROM         dbo.transaksi_sppu INNER JOIN
                      dbo.mt_account ON dbo.transaksi_sppu.acc_no_1 = dbo.mt_account.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [transaksi_sppu_2_v]");
    }
};
