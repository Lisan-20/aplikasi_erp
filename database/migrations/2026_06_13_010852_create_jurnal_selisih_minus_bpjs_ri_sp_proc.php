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
CREATE OR ALTER PROCEDURE [dbo].[jurnal_selisih_minus_bpjs_ri_sp]
AS
BEGIN
--- selisih positif

insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_bagian,kode_tc_trans_kasir) select '1130101' as acc_no,selisih as tx_nominal,'Piutang usaha sementara '+cast(noSep as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,GETDATE() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,'1' as no_det_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'30' as kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_bagian,kode_tc_trans_kasir from jurnal_selisih_bpjs_ri_baru_v where selisih>0 and flag_jurnal is null;
insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_bagian,kode_tc_trans_kasir) select '3110104' as acc_no,selisih as tx_nominal,'Pendapatan Selisih Billing BPJS RI  '+cast(noSep as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,GETDATE() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,'2' as no_det_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'30' as kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_bagian,kode_tc_trans_kasir  from jurnal_selisih_bpjs_ri_baru_v where  selisih>0 and flag_jurnal is null;

-- selisih minus
insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_bagian,kode_tc_trans_kasir) select '1130101' as acc_no,(selisih*-1) as tx_nominal,'Piutang usaha sementara '+cast(noSep as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,GETDATE() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,'1' as no_det_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'30' as kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_bagian,kode_tc_trans_kasir from jurnal_selisih_bpjs_ri_baru_v where selisih<0 and flag_jurnal is null;
insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_bagian,kode_tc_trans_kasir) select '4110111' as acc_no,(selisih*-1) as tx_nominal,'Biaya Selisih Billing BPJS RI  '+cast(noSep as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,GETDATE() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,'2' as no_det_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'30' as kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_bagian,kode_tc_trans_kasir  from jurnal_selisih_bpjs_ri_baru_v where  selisih<0 and flag_jurnal is null;

--adm
--insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,no_mr,no_registrasi,kode_perusahaan) select '3160101' as acc_no,adm as tx_nominal,'Administrasi '+cast(nama_pasien as varchar(255)) as tx_uraian,tgl_jam_keluar as tx_tgl,GETDATE() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,'1' as no_det_jurnal,'AJP'+'-'+cast(no_sep as varchar(255)) as no_bukti,kode_bagian,no_induk,'31' as kel_jurnal,no_mr,no_registrasi,kode_perusahaan from jurnal_selisih_bpjs_ri_v where adm>0 and flag_jurnal is null;
--insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,no_mr,no_registrasi,kode_perusahaan) select '1130101' as acc_no,adm as tx_nominal,'Piutang usaha sementara  '+cast(nama_pasien as varchar(255)) as tx_uraian,tgl_jam_keluar as tx_tgl,GETDATE() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,'2' as no_det_jurnal,'AJP'+'-'+cast(no_sep as varchar(255)) as no_bukti,kode_bagian,no_induk,'31' as kel_jurnal,no_mr,no_registrasi,kode_perusahaan  from jurnal_selisih_bpjs_ri_v where  adm>0 and flag_jurnal is null;

update jurnal_selisih_bpjs_ri_baru2_v set flag_jurnal=1 where flag_jurnal is null and noSep in (select noSep from jurnal_selisih_bpjs_ri_baru_v);
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_selisih_minus_bpjs_ri_sp");
    }
};
