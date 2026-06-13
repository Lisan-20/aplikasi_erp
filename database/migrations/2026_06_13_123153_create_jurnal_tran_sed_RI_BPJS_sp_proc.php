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
CREATE PROCEDURE [dbo].[jurnal_tran_sed_RI_BPJS_sp]
AS
BEGIN
    -- bpjs rawat inap
    update upd_kode_bagian_v set kode_bagian=kode_bagian_kasir;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select acc_no,tx_nominal,'Pendapatan Ruangan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian_asal as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah from jurnal_tran_sed_RI_BPJS_v where tx_nominal>0 and kode=1 and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select acc_no,tx_nominal,'Pendapatan Administrasi '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian_asal as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah from jurnal_tran_sed_RI_BPJS_v where tx_nominal>0 and kode=2 and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select acc_no,tx_nominal,'Pendapatan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian_asal as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah from jurnal_tran_sed_RI_BPJS_v where tx_nominal>0 and kode=3 and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_dr,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select acc_no,tx_nominal,'Hutang Jasa Dokter Sementara'+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_dr,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah from jurnal_tran_sed_RI_BPJS_v where tx_nominal>0 and kode=4 and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select acc_no,tx_nominal,'pendapatan Sewa Alat '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian_asal as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah from jurnal_tran_sed_RI_BPJS_v where tx_nominal>0 and kode=5 and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select acc_no,tx_nominal,'Pendapatan Ambulance'+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian_asal as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah from jurnal_tran_sed_RI_BPJS_v where tx_nominal>0 and kode=6 and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select acc_no,tx_nominal,'Pendapatan Sarana '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian_asal as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah from jurnal_tran_sed_RI_BPJS_v where tx_nominal>0 and kode=7 and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select acc_no,tx_nominal,'Pendapatan Lain-lain '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian_asal as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah from jurnal_tran_sed_RI_BPJS_v where tx_nominal>0 and kode=8 and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select acc_no,tx_nominal,'Pendapatan Obat/Alkes '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))+'/'+kode_barang+'/'+cast(jumlah as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian_asal as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah from jurnal_tran_sed_RI_BPJS_v where tx_nominal>0 and kode=9 and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select acc_no,tx_nominal,'Pendapatan Pemeriksaan Keluar '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian_asal as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah from jurnal_tran_sed_RI_BPJS_v where tx_nominal>0 and kode=10 and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang,kd_tr_resep) select acc_no,tx_nominal,'Pendapatan Farmasi '+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))+'/'+kode_barang+'/'+cast(jumlah as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian_asal as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah,kd_tr_resep from jurnal_tran_sed_RI_BPJS_v where tx_nominal>0 and kode=18 and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select acc_no,tx_nominal,'Pendapatan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian_asal as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah from jurnal_tran_sed_RI_BPJS_v where tx_nominal>0 and kode in(15,16,17,19) and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);

--UPDATE tc_trans_kasir set flag_jurnal=1 WHERE kode_tc_trans_kasir in(select kode_tc_trans_kasir from tx_harian Where kel_jurnal=1 and tx_tipe='D' and YEAR(tx_tgl)=year(GETDATE())) and flag_jurnal=0;
--UPDATE tc_trans_pelayanan set flag_jurnal=1 WHERE kode_tc_trans_kasir in(select kode_tc_trans_kasir from tx_harian Where kel_jurnal=1 and tx_tipe='D' and YEAR(tx_tgl)=year(GETDATE())) and flag_jurnal=0;
--jurnal ke-2 rincian :			
--selisih (+):	piutang sementara D		
--		pendapatan ranap	K
			
--selisih (-):	pendapatan ranap	D	
--		piutang sementara	K

	--BPJS
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select '1130101' as acc_no,(tx_nominal * -1) as tx_nominal,'Piutang Usaha Sementara MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian_asal as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah from jurnal_tran_sed_selisih_BPJS_RI_v where kode in(31) and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select acc_kredit as acc_no,(tx_nominal * -1) as tx_nominal,'Pendapatan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian_asal as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah from jurnal_tran_sed_selisih_BPJS_RI_v where kode in(31) and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);
  
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select acc_debet as acc_no,tx_nominal,'Pendapatan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian_asal as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah from jurnal_tran_sed_selisih_BPJS_RI_v where kode in(32) and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select '1130101' as acc_no,tx_nominal,'Piutang Usaha Sementara MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian_asal as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah from jurnal_tran_sed_selisih_BPJS_RI_v where kode in(32) and no_registrasi in (select no_registrasi from filter_jurnal_RI_bpjs);
END


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_tran_sed_RI_BPJS_sp");
    }
};
