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
CREATE PROCEDURE [dbo].[jurnal_biaya_gizi_RI_sp]
AS
BEGIN
--- selisih positif

insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kel_jurnal,no_mr,no_registrasi,kode_bagian,kode_tc_trans_kasir) select '1150201' as acc_no,tx_nominal,'Persediaan Makanan Gizi'+cast(no_registrasi as varchar(255))+'/'+cast(nama_klas as varchar(255)) as tx_uraian,tx_tgl,GETDATE() as tx_jam,'K' as tx_tipe,'1' as no_jurnal,'1' as no_det_jurnal,no_bukti,'32' as kel_jurnal,no_mr,no_registrasi,kode_bagian,kode_tc_trans_kasir from jurnal_gizi_2_v where  flag_gizi is null;
insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kel_jurnal,no_mr,no_registrasi,kode_bagian,kode_tc_trans_kasir) select '4110112' as acc_no,tx_nominal,'Biaya Makanan/Gizi Rawat Inap '+cast(no_registrasi as varchar(255))+'/'+cast(nama_klas as varchar(255)) as tx_uraian,tx_tgl,GETDATE() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,'2' as no_det_jurnal,no_bukti,'32' as kel_jurnal,no_mr,no_registrasi,kode_bagian,kode_tc_trans_kasir  from jurnal_gizi_2_v where  flag_gizi is null;


update jurnal_gizi_2_v set flag_gizi=1 where flag_gizi is null ;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_biaya_gizi_RI_sp");
    }
};
