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
        DB::statement("CREATE OR ALTER VIEW dbo.transaksi_hutang_v
AS
SELECT     dbo.transaksi_hutang.id_trans_hutang, dbo.transaksi_hutang.acc_no_1, dbo.transaksi_hutang.acc_no_2, dbo.transaksi_hutang.tx_tipe, 
                      dbo.transaksi_hutang.jumlah_transaksi, dbo.transaksi_hutang.no_bukti, dbo.transaksi_hutang.tgl_transaksi, dbo.transaksi_hutang.flag_jurnal, 
                      dbo.transaksi_hutang.keterangan, dbo.transaksi_hutang.inp_tgl, dbo.transaksi_hutang.inp_id, dbo.transaksi_hutang.kode_bagian, 
                      dbo.transaksi_hutang.kode_supplier, dbo.transaksi_hutang.kode_perusahaan, dbo.transaksi_hutang.kode_dr, dbo.transaksi_hutang.stat, 
                      dbo.transaksi_hutang.stat_id, dbo.transaksi_hutang.tgl_bayar, dbo.transaksi_hutang.status_bayar, dbo.transaksi_hutang.flag_ver, dbo.transaksi_hutang.tgl_ver, 
                      dbo.transaksi_hutang.flag_tmp, dbo.transaksi_hutang.flag_modul, dbo.transaksi_hutang.tgl_tempo, dbo.transaksi_hutang.jumlah_ppn, 
                      dbo.transaksi_hutang.jumlah_pph, dbo.transaksi_hutang.total, dbo.transaksi_hutang.id_bd_tc_trans, dbo.transaksi_hutang.referensi, 
                      dbo.mt_supplier.namasupplier
FROM         dbo.mt_supplier RIGHT OUTER JOIN
                      dbo.transaksi_hutang ON dbo.mt_supplier.kodesupplier = dbo.transaksi_hutang.kode_supplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [transaksi_hutang_v]");
    }
};
