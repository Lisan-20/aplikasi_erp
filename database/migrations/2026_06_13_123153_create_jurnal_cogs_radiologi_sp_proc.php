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
CREATE PROCEDURE [dbo].[jurnal_cogs_radiologi_sp]
AS
BEGIN
    -- COGS
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select '4130104' as acc_no,tx_nominal,'Biaya Radiologi '+SPACE(2)+' Kode Barang/Jumlah : '+kode_barang+'/'+cast(vol as varchar(255)) as tx_uraian,tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,no_bukti,kode_bagian as kode_bagian,'15' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,vol from jurnal_cogs_radiologi_v ;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select '1150102' as acc_no,tx_nominal,'Biaya Radiologi '+SPACE(2)+' Kode Barang/Jumlah : '+kode_barang+'/'+cast(vol as varchar(255)) as tx_uraian,tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,no_bukti,kode_bagian as kode_bagian,'15' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,vol from jurnal_cogs_radiologi_v ;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select '4130104' as acc_no,tx_nominal,'Biaya Radiologi '+SPACE(2)+' Kode Barang/Jumlah : '+kode_barang+'/'+cast(vol as varchar(255)) as tx_uraian,tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,no_bukti,kode_bagian as kode_bagian,'16' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,vol from jurnal_cogs_radiologi_ranap_v ;
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select '1150102' as acc_no,tx_nominal,'Biaya Radiologi '+SPACE(2)+' Kode Barang/Jumlah : '+kode_barang+'/'+cast(vol as varchar(255)) as tx_uraian,tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,no_bukti,kode_bagian as kode_bagian,'16' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,vol from jurnal_cogs_radiologi_ranap_v ;
	
	UPDATE tx_harian set flag_cogs=1 WHERE kel_jurnal in (1,2) and kode_bagian='050201' and flag_cogs is null ;

END


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_cogs_radiologi_sp");
    }
};
