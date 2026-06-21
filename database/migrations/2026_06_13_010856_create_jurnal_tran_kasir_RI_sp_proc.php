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
        DB::unprepared("-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE OR ALTER PROCEDURE [dbo].[jurnal_tran_kasir_RI_sp]
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	--SET NOCOUNT ON;

    -- Insert statements for procedure here
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kd_trans_bendahara,kd_group_trans,kode_inap) select acc_debet as acc_no,jumlah as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'110001' as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,1107 as kd_trans_bendahara,1 as kd_group_trans,kode_inap from jurnal_trans_kasir_RI_v where jumlah>0 AND kode=1 AND seri_kuitansi='RI' and acc_debet>0 ;--AND no_registrasi in(select no_registrasi from filter_jurnal_RI)
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kd_trans_bendahara,kd_group_trans,kode_inap) select acc_debet as acc_no,jumlah as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'110001' as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,1107 as kd_trans_bendahara,1 as kd_group_trans,kode_inap from jurnal_trans_kasir_RI_v where jumlah>0 AND kode=3 AND seri_kuitansi='RI' and acc_debet>0 ;--AND no_registrasi in(select no_registrasi from filter_jurnal_RI) Kartu Kredit
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kd_trans_bendahara,kd_group_trans,kode_inap) select acc_debet as acc_no,jumlah as tx_nominal,'Piutang Usaha Sementara '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'110001' as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,1107 as kd_trans_bendahara,1 as kd_group_trans,kode_inap from jurnal_trans_kasir_RI_v where jumlah>0 AND kode=1 AND seri_kuitansi='AI' and acc_debet>0 ;--AND no_registrasi in(select no_registrasi from filter_jurnal_RI)
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kd_trans_bendahara,kd_group_trans,kode_inap) select acc_kredit as acc_no,jumlah as tx_nominal,'Pengembalian Uang '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'110001' as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,1107 as kd_trans_bendahara,1 as kd_group_trans,kode_inap from jurnal_trans_kasir_RI_v where jumlah>0 AND kode=4 AND seri_kuitansi='RI' and acc_kredit>0 ;--AND no_registrasi in(select no_registrasi from filter_jurnal_RI)
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_perusahaan,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_inap) select acc_debet as acc_no,jumlah as tx_nominal,'Piutang Usaha Sementara '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,kode_perusahaan,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_inap from jurnal_trans_kasir_RI_v where jumlah>0 AND kode=5 AND seri_kuitansi='AI' ;--AND no_registrasi in(select no_registrasi from filter_jurnal_RI)
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_inap) select acc_debet as acc_no,jumlah as tx_nominal,'Piutang Usaha Sementara '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'110001' as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_inap from jurnal_trans_kasir_RI_v where jumlah>0 AND kode=3 AND seri_kuitansi='AI' ;--AND no_registrasi in(select no_registrasi from filter_jurnal_RI)
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kd_trans_bendahara,kd_group_trans,kode_inap) select acc_debet as acc_no,jumlah as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'110001' as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,1107 as kd_trans_bendahara,1 as kd_group_trans,kode_inap from jurnal_trans_kasir_RI_v where jumlah>0 AND kode=2 AND seri_kuitansi='RI' and acc_debet>0 ;--AND no_registrasi in(select no_registrasi from filter_jurnal_RI)
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kd_trans_bendahara,kd_group_trans,kode_inap) select acc_debet as acc_no,jumlah as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'110001' as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,1107 as kd_trans_bendahara,1 as kd_group_trans,kode_inap from jurnal_trans_kasir_RI_v where jumlah>0 AND kode=5 AND seri_kuitansi='RI' and acc_debet>0 ;--AND no_registrasi in(select no_registrasi from filter_jurnal_RI)

--jurnal_UM_pasien_pulang_bpjs_v
--insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,referensi) select acc_no,jumlah as tx_nominal,'Pelunasan Uang Muka Pasien Pulang MR/REG '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,GETDATE() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,'1' as no_det_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian,no_induk,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as referensi from jurnal_UM_pasien_pulang_bpjs_v where flag_jurnal is null ;
--update jurnal_UM_pasien_pulang_bpjs_v set flag_jurnal=1 where flag_jurnal is null and kode_tc_trans_kasir in (select kode_tc_trans_kasir from tx_harian where kel_jurnal=2);
end
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_tran_kasir_RI_sp");
    }
};
