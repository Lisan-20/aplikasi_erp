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
        DB::statement("CREATE OR ALTER VIEW dbo.jurnal_hutang_luar_modul_v
AS
SELECT     dbo.transaksi_hutang.id_trans_hutang, dbo.transaksi_hutang.acc_no_1 AS ACC_K, dbo.transaksi_hutang.acc_no_2 AS ACC_D, dbo.transaksi_hutang.tx_tipe, 
                      dbo.transaksi_hutang.jumlah_transaksi, dbo.transaksi_hutang.no_bukti, dbo.transaksi_hutang.tgl_transaksi AS tgl, dbo.transaksi_hutang.flag_jurnal, 
                      dbo.transaksi_hutang.keterangan, dbo.transaksi_hutang.inp_tgl, dbo.transaksi_hutang.inp_id, dbo.transaksi_hutang.kode_bagian, 
                      dbo.transaksi_hutang.kode_supplier, dbo.transaksi_hutang.kode_perusahaan, dbo.transaksi_hutang.kode_dr, dbo.transaksi_hutang.stat, 
                      dbo.transaksi_hutang.stat_id, dbo.transaksi_hutang.tgl_bayar, dbo.transaksi_hutang.status_bayar, dbo.transaksi_hutang.flag_ver, dbo.transaksi_hutang.tgl_ver, 
                      dbo.transaksi_hutang.flag_tmp, dbo.transaksi_hutang.flag_modul, dbo.transaksi_hutang.tgl_tempo, dbo.transaksi_hutang.jumlah_ppn, 
                      dbo.transaksi_hutang.jumlah_pph, dbo.transaksi_hutang.total, dbo.transaksi_hutang.id_bd_tc_trans, dbo.transaksi_hutang.referensi, dbo.mt_supplier.namasupplier, 
                      dbo.mt_karyawan.nama_pegawai, dbo.mt_karyawan.no_induk
FROM         dbo.transaksi_hutang LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.transaksi_hutang.inp_id = dbo.mt_karyawan.no_induk LEFT OUTER JOIN
                      dbo.mt_supplier ON dbo.transaksi_hutang.kode_supplier = dbo.mt_supplier.kodesupplier
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_hutang_luar_modul_v]");
    }
};
