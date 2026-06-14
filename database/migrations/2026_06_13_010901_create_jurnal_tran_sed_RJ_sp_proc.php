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
CREATE OR ALTER PROCEDURE [dbo].[jurnal_tran_sed_RJ_sp]
AS
BEGIN
    -- partik
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_no,tx_nominal,'Pendapatan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_tran_sed_RJ_v where tx_nominal>0 and kode=3 AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from is_valid_jurnal_rj_v);--AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj)
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang) select acc_no,tx_nominal,'Pendapatan Administrasi '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang from jurnal_tran_sed_RJ_v where tx_nominal>0 and kode=2 AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from is_valid_jurnal_rj_v);--AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj)
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select acc_no,tx_nominal,'Pendapatan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))+'/'+kode_barang+'/'+cast(jumlah as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang, jumlah as jumlah_barang from jurnal_tran_sed_RJ_v where tx_nominal>0 and kode=11 AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from is_valid_jurnal_rj_v);--AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj)
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,kode_dr) select acc_no,tx_nominal,'Hutang Jasa Dokter Sementara '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,kode_dr from jurnal_tran_sed_RJ_v where tx_nominal>0 and kode=4 AND acc_no<>'2110507' AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from is_valid_jurnal_rj_v);--AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj)
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,kode_dr) select acc_no,tx_nominal,'Hutang Paramedis Lainnya '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,kode_dr from jurnal_tran_sed_RJ_v where tx_nominal>0 and kode=31 AND acc_no<>'2110504' AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from is_valid_jurnal_rj_v);--AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj)
	--insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang) select acc_no,tx_nominal,'Retur '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))+'/'+kode_barang+'/'+cast(jumlah as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang from v_jurnal_tran_sed_RJ_debet where tx_nominal>0 and kode=13 AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang) select acc_no,tx_nominal,'Retur Administrasi '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang from v_jurnal_tran_sed_RJ_debet where tx_nominal>0 and kode=14 AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from is_valid_jurnal_rj_v);--AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj)
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_no,tx_nominal,'Pendapatan Sarana '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_tran_sed_RJ_v where tx_nominal>0 and kode=7 AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from is_valid_jurnal_rj_v);--AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj)
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kd_tr_resep) select acc_no,tx_nominal,'Pendapatan Obat & alkes '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))+'/'+kode_barang+'/'+CAST(jumlah as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kd_tr_resep from jurnal_tran_sed_RJ_v where tx_nominal>0 and kode=9 AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from is_valid_jurnal_rj_v);--AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj)
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_no,tx_nominal,'Pendapatan Ambulance'+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_tran_sed_RJ_v where tx_nominal>0 and kode=6 AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from is_valid_jurnal_rj_v);--AND kode_tc_trans_kasir in(select kode_tc_trans_kasir from filter_jurnal_rj)
UPDATE tc_trans_kasir set flag_jurnal=1 WHERE kode_tc_trans_kasir in(select kode_tc_trans_kasir from tx_harian Where kel_jurnal=1 and tx_tipe='D' and YEAR(tx_tgl)=year(GETDATE())) and flag_jurnal=0;
UPDATE tc_trans_pelayanan set flag_jurnal=1 WHERE kode_tc_trans_kasir in(select kode_tc_trans_kasir from tx_harian Where kel_jurnal=1 and tx_tipe='D' and YEAR(tx_tgl)=year(GETDATE())) and flag_jurnal=0;

END


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_tran_sed_RJ_sp");
    }
};
