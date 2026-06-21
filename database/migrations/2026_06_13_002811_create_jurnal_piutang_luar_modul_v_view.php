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
        DB::statement("CREATE OR ALTER VIEW dbo.jurnal_piutang_luar_modul_v
AS
SELECT     dbo.transaksi_piutang.id_trans_piutang, dbo.transaksi_piutang.acc_no_1 AS ACC_D, dbo.transaksi_piutang.acc_no_2 AS ACC_K, dbo.transaksi_piutang.tx_tipe, 
                      dbo.transaksi_piutang.jumlah_transaksi, dbo.transaksi_piutang.no_bukti, dbo.transaksi_piutang.tgl_transaksi AS tgl, dbo.transaksi_piutang.flag_jurnal, 
                      dbo.transaksi_piutang.keterangan, dbo.transaksi_piutang.inp_tgl, dbo.transaksi_piutang.inp_id, dbo.transaksi_piutang.kode_bagian, 
                      dbo.transaksi_piutang.kode_supplier, dbo.transaksi_piutang.kode_perusahaan, dbo.transaksi_piutang.kode_dr, dbo.transaksi_piutang.stat, 
                      dbo.transaksi_piutang.stat_id, dbo.transaksi_piutang.tgl_bayar, dbo.transaksi_piutang.status_bayar, dbo.transaksi_piutang.flag_ver, dbo.transaksi_piutang.tgl_ver, 
                      dbo.transaksi_piutang.flag_tmp, dbo.transaksi_piutang.flag_modul, dbo.transaksi_piutang.tgl_tempo, dbo.transaksi_piutang.jumlah_ppn, 
                      dbo.transaksi_piutang.jumlah_pph, dbo.transaksi_piutang.total, dbo.transaksi_piutang.id_bd_tc_trans, dbo.mt_perusahaan.nama_perusahaan, 
                      dbo.mt_karyawan.nama_pegawai, dbo.mt_karyawan.no_induk
FROM         dbo.transaksi_piutang LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.transaksi_piutang.inp_id = dbo.mt_karyawan.no_induk LEFT OUTER JOIN
                      dbo.mt_perusahaan ON dbo.transaksi_piutang.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_piutang_luar_modul_v]");
    }
};
