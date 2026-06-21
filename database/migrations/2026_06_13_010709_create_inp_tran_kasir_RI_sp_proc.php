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

CREATE OR ALTER PROCEDURE [dbo].[inp_tran_kasir_RI_sp]
as
update update_kode_bagian_asal_v set kode_bagian_asal=kode_bagian_masuk;
update update_bagian_um_v set kode_bagian=kode_bagian_masuk;
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode,kode_inap) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,cast(seri_kuitansi as varchar(2)) as seri_kuitansi,no_induk,tgl_jam,tunai as jumlah,kode_bagian,getdate() as tgl_proses,1 as kode,kode_inap from v_trans_kasir_RI where flag_jurnal=0 and tunai>0 and seri_kuitansi<>'UM';
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode,kode_inap) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,cast(seri_kuitansi as varchar(2)) as seri_kuitansi,no_induk,tgl_jam,tunai as jumlah,kode_bagian,getdate() as tgl_proses,1 as kode,kode_inap from v_trans_kasir_RI where flag_jurnal=0 and tunai=0 and seri_kuitansi='RI'; --untuk yg kuitansi 0 bill=UM
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode,kode_inap) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,debet as jumlah,kode_bagian,getdate() as tgl_proses,2 as kode,kode_inap from v_trans_kasir_RI where flag_jurnal=0 and debet>0;
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode,kode_inap) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,kredit as jumlah,kode_bagian,getdate() as tgl_proses,3 as kode,kode_inap from v_trans_kasir_RI where flag_jurnal=0 and kredit>0;
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode,kode_inap) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,nd as jumlah,kode_bagian,getdate() as tgl_proses,4 as kode,kode_inap from v_trans_kasir_RI where flag_jurnal=0 and nd>0;
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode,kode_perusahaan,kode_inap) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,nk_perusahaan as jumlah,kode_bagian,getdate() as tgl_proses,5 as kode,kode_perusahaan,kode_inap from v_trans_kasir_RI where flag_jurnal=0 and nk_perusahaan>0;
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode,kode_perusahaan,kode_inap) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,nk as jumlah,kode_bagian,getdate() as tgl_proses,5 as kode,kode_perusahaan,kode_inap from v_trans_kasir_RI where flag_jurnal=0 and nk>0;
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode,kode_perusahaan,kode_inap) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,nk_karyawan as jumlah,kode_bagian,getdate() as tgl_proses,5 as kode,kode_perusahaan,kode_inap from v_trans_kasir_RI where flag_jurnal=0 and nk_karyawan>0;
--v_trans_UM_pulang
insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode,kode_perusahaan,kode_inap) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,uang_muka as jumlah,kode_bagian,getdate() as tgl_proses,6 as kode,kode_perusahaan,kode_inap from v_trans_UM_pulang where flag_jurnal=0;
update v_trans_UM_pulang set flag_jurnal=1 where flag_jurnal=0;

--selisih bpjs
--insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode,kode_perusahaan) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,selisih as jumlah,kode_bagian,getdate() as tgl_proses,7 as kode,kode_perusahaan from v_trans_selisih_BPJS_RI_2_v where status_ver=0 and selisih>0;
--insert into tran_kasir (kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,jumlah,kode_bagian,tgl_proses,kode,kode_perusahaan) select kode_tc_trans_kasir,no_registrasi,no_mr,no_kuitansi,seri_kuitansi,no_induk,tgl_jam,(selisih * -1) as jumlah,kode_bagian,getdate() as tgl_proses,7 as kode,kode_perusahaan from v_trans_selisih_BPJS_RI_2_v where status_ver=0 and selisih<0;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_tran_kasir_RI_sp");
    }
};
