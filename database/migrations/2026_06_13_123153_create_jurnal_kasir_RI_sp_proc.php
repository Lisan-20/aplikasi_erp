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
CREATE PROCEDURE [dbo].[jurnal_kasir_RI_sp]
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	--SET NOCOUNT ON;

    -- Insert statements for procedure here
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_debet as acc_no,tunai as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'110001' as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_kasir_RI_v where kode_jenis_proses=1 and tunai>0 and flag_jurnal=0;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_perusahaan) select acc_debet as acc_no,nk_perusahaan as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255)) as no_bukti,'110001' as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_perusahaan from jurnal_kasir_RI_v where kode_jenis_proses=32 and nk_perusahaan>0 and flag_jurnal=0;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_perusahaan) select acc_debet as acc_no,nk as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255)) as no_bukti,'110001' as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,99 AS kode_perusahaan from jurnal_kasir_RI_v where kode_jenis_proses=32 and nk>0 and flag_jurnal=0;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_debet as acc_no,kredit as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255)) as no_bukti,'110001' as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_kasir_RI_v where kode_jenis_proses=3 and kredit>0 and flag_jurnal=0;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_kredit as acc_no,nd as tx_nominal,'Pengembalian Uang Perawatan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255)) as no_bukti,'110001' as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_kasir_RI_v where kode_jenis_proses=4 and nd>0 and flag_jurnal=0;
	
END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_kasir_RI_sp");
    }
};
