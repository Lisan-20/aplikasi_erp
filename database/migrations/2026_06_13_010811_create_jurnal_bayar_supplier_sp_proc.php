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
        DB::unprepared("













CREATE OR ALTER PROCEDURE [dbo].[jurnal_bayar_supplier_sp]
AS
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,kode_bank,kode_supplier,kd_group_trans,kd_trans_bendahara,referensi) SELECT acc_no,(jumlah) as tx_nominal,cast(uraian as varchar(255)) as tx_uraian,tgl_transaksi as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,id_bd_tc_trans as no_jurnal,no_urut as no_det_jurnal,no_bukti,kode_bagian,no_induk,'5' as kel_jurnal,id_bank as kode_bank,kode_suplier as kode_supplier,kd_group_trans,kd_trans_bendahara,no_ref as referensi FROM bd_tc_trans_v WHERE flag_jurnal=1 and tx_tipe=1 ;
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,kode_bank,kode_supplier,kd_group_trans,kd_trans_bendahara,referensi) SELECT acc_no,(jumlah) as tx_nominal,cast(uraian as varchar(255)) as tx_uraian,tgl_transaksi as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,id_bd_tc_trans as no_jurnal,no_urut as no_det_jurnal,no_bukti,kode_bagian,no_induk,'5' as kel_jurnal,id_bank as kode_bank,kode_suplier as kode_supplier,kd_group_trans,kd_trans_bendahara,no_ref as referensi FROM bd_tc_trans_v WHERE flag_jurnal=1 and tx_tipe=0 ;

update bd_tc_trans_v set flag_jurnal=2 where flag_jurnal =1;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_bayar_supplier_sp");
    }
};
