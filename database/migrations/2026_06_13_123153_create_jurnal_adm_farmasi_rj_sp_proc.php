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
CREATE PROCEDURE [dbo].[jurnal_adm_farmasi_rj_sp]
AS
BEGIN
	--jurnal_administrasi_farmasi_v
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_perusahaan) select acc_kredit as acc_no,lain_lain as tx_nominal,'Pendapatan Administrasi'+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_perusahaan from jurnal_administrasi_farmasi_v ;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_perusahaan) select acc_debet as acc_no,lain_lain as tx_nominal,'Pendapatan Administrasi'+nama_bagian+' MR/REG : '+no_mr+'/'+cast(no_registrasi as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian as kode_bagian,'1' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_perusahaan from jurnal_adm_far_kredit_v ;
END


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_adm_farmasi_rj_sp");
    }
};
