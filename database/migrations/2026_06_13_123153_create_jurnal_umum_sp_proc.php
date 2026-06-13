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
        DB::unprepared("CREATE proc [dbo].[jurnal_umum_sp]
as
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,kode_dr,kode_supplier,referensi,kode_perusahaan,ko_wil) SELECT acc_no,(jumlah) as tx_nominal,cast(keterangan as varchar(255)) as tx_uraian,tgl_transaksi as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,id_transaksi as no_jurnal,id_transaksi_detail as no_det_jurnal,no_bukti, kode_bagian,no_induk,'18' as kel_jurnal,kode_dr,kode_supplier as kode_supplier,no_bp as referensi,kode_perusahaan,kd_wil as ko_wil FROM transaksi_detail_v WHERE flag_jurnal<>2 AND flag_ver=1 and tipe_tx=0;
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,kode_dr,kode_supplier,referensi,kode_perusahaan,ko_wil) SELECT acc_no,(jumlah) as tx_nominal,cast(keterangan as varchar(255)) as tx_uraian,tgl_transaksi as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,id_transaksi as no_jurnal,id_transaksi_detail as no_det_jurnal,no_bukti, kode_bagian,no_induk,'18' as kel_jurnal,kode_dr,kode_supplier as kode_supplier,no_bp as referensi,kode_perusahaan,kd_wil as ko_wil FROM transaksi_detail_v WHERE flag_jurnal<>2 AND flag_ver=1 and tipe_tx=1;

update transaksi_detail_v set flag_jurnal=2 where flag_jurnal<>2 and flag_ver=1;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_umum_sp");
    }
};
