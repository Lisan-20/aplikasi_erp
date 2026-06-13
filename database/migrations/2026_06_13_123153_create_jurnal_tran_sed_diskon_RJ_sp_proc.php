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
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[jurnal_tran_sed_diskon_RJ_sp]
AS
BEGIN
    -- partik
    --Diskon RS Tindakan RJ
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_no,tx_nominal,'Diskon Pendapatan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_trans_sed_diskon_RJ_v where tx_nominal>0 and kode=27 AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from is_valid_jurnal_rj_v);--AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj)
	--Diskon Administrasi RJ
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang) select acc_no,tx_nominal,'Diskon Administrasi '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang from jurnal_trans_sed_diskon_RJ_v where tx_nominal>0 and kode=29 AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from is_valid_jurnal_rj_v);--AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj)
	--Diskon Farmasi RJ
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select acc_no,tx_nominal,'Diskon Pendapatan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))+'/'+kode_barang+'/'+cast(jumlah as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang, jumlah as jumlah_barang from jurnal_trans_sed_diskon_RJ_v where tx_nominal>0 and kode=21 AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from is_valid_jurnal_rj_v);--AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj)
	-- Diskon Dokter RJ
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,kode_dr) select acc_no,tx_nominal,'Diskon Hutang Jasa Dokter Sementara '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,kode_dr from jurnal_trans_sed_diskon_RJ_v where tx_nominal>0 and kode=25 AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from is_valid_jurnal_rj_v);--AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj)
	-- diskon Sarana RS
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_no,tx_nominal,'Diskon Pendapatan Sarana '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_trans_sed_diskon_RJ_v where tx_nominal>0 and kode=28 AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from is_valid_jurnal_rj_v);--AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj)
	-- diskon obat alkes RJ
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_no,tx_nominal,'Diskon Pendapatan Obat & alkes '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_trans_sed_diskon_RJ_v where tx_nominal>0 and kode=30 AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from is_valid_jurnal_rj_v);--AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj)
	
END


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_tran_sed_diskon_RJ_sp");
    }
};
