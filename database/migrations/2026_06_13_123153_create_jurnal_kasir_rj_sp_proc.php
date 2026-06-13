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
CREATE PROCEDURE [dbo].[jurnal_kasir_rj_sp]
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	--SET NOCOUNT ON;

    -- Insert statements for procedure here
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kd_trans_bendahara,kd_group_trans) select acc_debet as acc_no,tunai as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'110001' as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,1107 as kd_trans_bendahara,1 as kd_group_trans from jurnal_kasir_rawat_jalan_v where kode_jenis_proses=1 and tunai>0;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kd_trans_bendahara,kd_group_trans) select acc_debet as acc_no,debet as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255)) as no_bukti,'110001' as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,1107 as kd_trans_bendahara,1 as kd_group_trans from jurnal_kasir_rawat_jalan_v where kode_jenis_proses=2 and debet>0;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_debet as acc_no,kredit as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255)) as no_bukti,'110001' as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_kasir_rawat_jalan_v where kode_jenis_proses=3 and kredit>0;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_perusahaan) select acc_debet as acc_no,nk_perusahaan as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255)) as no_bukti,'110001' as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_perusahaan from jurnal_kasir_rawat_jalan_v where kode_jenis_proses=32 and nk_perusahaan>0;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_perusahaan) select acc_debet as acc_no,nk as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255)) as no_bukti,'110001' as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,99 AS kode_perusahaan from jurnal_kasir_rawat_jalan_v where kode_jenis_proses=32 and nk>0;
end");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_kasir_rj_sp");
    }
};
