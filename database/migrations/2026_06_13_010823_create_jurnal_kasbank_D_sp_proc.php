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












CREATE OR ALTER PROCEDURE [dbo].[jurnal_kasbank_D_sp]
AS
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,kode_bank,kode_dr,kode_supplier,kd_group_trans,kd_trans_bendahara,referensi,kode_perusahaan,ko_wil) SELECT acc_no,(jumlah) as tx_nominal,cast(uraian as varchar(255)) as tx_uraian,tgl_transaksi as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,id_bd_tc_trans as no_jurnal,no_urut as no_det_jurnal,no_bukti, kode_bagian,no_induk,'4' as kel_jurnal,id_bank as kode_bank,kode_dr,kode_suplier as kode_supplier,kd_group_trans,kd_trans_bendahara,referensi,kode_perusahaan,ko_wil FROM v_jurnal_KB WHERE flag_jurnal=1 and tx_tipe=0 ;
update v_jurnal_KB set flag_jurnal=2 where flag_jurnal =1 and tx_tipe=0;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_kasbank_D_sp");
    }
};
