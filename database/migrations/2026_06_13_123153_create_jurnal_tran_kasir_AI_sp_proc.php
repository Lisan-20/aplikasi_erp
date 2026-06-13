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
CREATE PROCEDURE [dbo].[jurnal_tran_kasir_AI_sp]
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	--SET NOCOUNT ON;

    -- Insert statements for procedure here
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kd_trans_bendahara,kd_group_trans) select acc_debet as acc_no,jumlah as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'110001' as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,1107 as kd_trans_bendahara,1 as kd_group_trans from jurnal_trans_kasir_AI_v where jumlah>0 AND kode=1 and acc_debet>0;-- AND no_registrasi in(select no_registrasi from filter_jurnal_RI);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_perusahaan,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_debet as acc_no,jumlah as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,kode_perusahaan,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_trans_kasir_AI_v where jumlah>0 AND kode=5 ;-- AND no_registrasi in(select no_registrasi from filter_jurnal_RI);
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir) select acc_debet as acc_no,jumlah as tx_nominal,'Penerimaan '+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255))as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar (255))as no_bukti,'110001' as kode_bagian,'2' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir from jurnal_trans_kasir_AI_v where jumlah>0 AND kode=3 ;-- AND no_registrasi in(select no_registrasi from filter_jurnal_RI);
	
end");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_tran_kasir_AI_sp");
    }
};
