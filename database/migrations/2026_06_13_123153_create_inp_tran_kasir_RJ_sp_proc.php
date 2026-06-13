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

CREATE proc [dbo].[inp_tran_kasir_RJ_sp]
as
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,cast(seri_kuitansi as varchar(2)) as seri_kuitansi,no_induk,tgl_jam,tunai as jumlah,kode_bagian,getdate() as tgl_proses,1 as kode from v_trans_kasir_RJ where flag_jurnal=0 and tunai>0;
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,debet as jumlah,kode_bagian,getdate() as tgl_proses,2 as kode from v_trans_kasir_RJ where flag_jurnal=0 and debet>0;
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,kredit as jumlah,kode_bagian,getdate() as tgl_proses,3 as kode from v_trans_kasir_RJ where flag_jurnal=0 and kredit>0;
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,nd as jumlah,kode_bagian,getdate() as tgl_proses,4 as kode from v_trans_kasir_RJ where flag_jurnal=0 and nd>0;
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode,kode_perusahaan) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,nk_perusahaan as jumlah,kode_bagian,getdate() as tgl_proses,5 as kode,kode_perusahaan from v_trans_kasir_RJ where flag_jurnal=0 and nk_perusahaan>0;
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode,kode_perusahaan) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,nk as jumlah,kode_bagian,getdate() as tgl_proses,5 as kode,kode_perusahaan from v_trans_kasir_RJ where flag_jurnal=0 and nk>0;
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode,kode_perusahaan) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,nk_karyawan as jumlah,kode_bagian,getdate() as tgl_proses,5 as kode,kode_perusahaan from v_trans_kasir_RJ where flag_jurnal=0 and nk_karyawan>0;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_tran_kasir_RJ_sp");
    }
};
