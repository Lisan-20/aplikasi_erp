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
create PROCEDURE [dbo].[jurnal_cogs_jual_bebas_sp]
AS
BEGIN
    -- COGS
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select '4120104' as acc_no,harga_beli as tx_nominal,'Biaya Obat '+SPACE(2)+' Kode Barang/Jumlah : '+kode_barang+'/'+cast(jumlah_barang as varchar(255)) as tx_uraian,tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,no_bukti,kode_bagian as kode_bagian,'19' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang from v_jurnal_cogs_obat_bebas where (kode_bagian like '01%' or kode_bagian like '02%' or kode_bagian like '05%');
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select '4140104' as acc_no,harga_beli as tx_nominal,'Biaya Obat '+SPACE(2)+' Kode Barang/Jumlah : '+kode_barang+'/'+cast(jumlah_barang as varchar(255)) as tx_uraian,tx_tgl,getdate() as tx_jam,'D' as tx_tipe,'1' as no_jurnal,no_bukti,kode_bagian as kode_bagian,'19' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang from v_jurnal_cogs_obat_bebas where (kode_bagian='060101');
	
	insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_bukti,kode_bagian,kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang) select '1150102' as acc_no,harga_beli as tx_nominal,'Biaya Obat '+SPACE(2)+' Kode Barang/Jumlah : '+kode_barang+'/'+cast(jumlah_barang as varchar(255)) as tx_uraian,tx_tgl,getdate() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,no_bukti,kode_bagian as kode_bagian,'19' as kel_jurnal,no_mr,no_registrasi,kode_tc_trans_kasir,kode_barang,jumlah_barang from v_jurnal_cogs_obat_bebas ;
UPDATE tx_harian set flag_cogs=1 WHERE kel_jurnal=9 and flag_cogs is null and kode_bagian<>'050201';

END


");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_cogs_jual_bebas_sp");
    }
};
