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
        DB::unprepared("CREATE proc [dbo].[jurnal_fee_dokter_sp]
as
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kel_jurnal,kode_dr,referensi) SELECT '2110504' as acc_no,(case when nominal is null then 0 else nominal end)+(case when potongan is null then 0 else potongan end)+(case when potongan_pajak is null then 0 else potongan_pajak end) as tx_nominal,'Hutang Jasa Dokter Sementara No Bukti :'+cast(no_bukti as varchar(255))as tx_uraian,tgl_pembentukan as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,id_bd_tc_hutang_dr as no_jurnal,2 as no_det_jurnal,no_bukti, '17' as kel_jurnal,kode_dokter as kode_dr,no_sppu as referensi FROM bd_tc_hutang_dr WHERE status_ver=0 and nominal>0 and rj_ri='RJ';
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kel_jurnal,kode_dr,referensi) SELECT '2110505' as acc_no,(case when nominal is null then 0 else nominal end)+(case when potongan is null then 0 else potongan end)+(case when potongan_pajak is null then 0 else potongan_pajak end) as tx_nominal,'Hutang Jasa Dokter Sementara No Bukti :'+cast(no_bukti as varchar(255))as tx_uraian,tgl_pembentukan as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,id_bd_tc_hutang_dr as no_jurnal,2 as no_det_jurnal,no_bukti, '17' as kel_jurnal,kode_dokter as kode_dr,no_sppu as referensi FROM bd_tc_hutang_dr WHERE status_ver=0 and nominal>0 and rj_ri='RI';
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kel_jurnal,kode_dr,referensi) SELECT '2110502' as acc_no,(case when nominal is null then 0 else nominal end) as tx_nominal,'Hutang Jasa Dokter No Bukti :'+cast(no_bukti as varchar(255))as tx_uraian,tgl_pembentukan as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,id_bd_tc_hutang_dr as no_jurnal,2 as no_det_jurnal,no_bukti, '17' as kel_jurnal,kode_dokter as kode_dr,no_sppu as referensi FROM bd_tc_hutang_dr WHERE status_ver=0 and nominal>0 ;
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kel_jurnal,kode_dr,referensi) SELECT '2110201' as acc_no,(case when potongan_pajak is null then 0 else potongan_pajak end) as tx_nominal,'Hutang Pajak Dokter No Bukti :'+cast(no_bukti as varchar(255))as tx_uraian,tgl_pembentukan as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,id_bd_tc_hutang_dr as no_jurnal,2 as no_det_jurnal,no_bukti, '17' as kel_jurnal,kode_dokter as kode_dr,no_sppu as referensi FROM bd_tc_hutang_dr WHERE status_ver=0 and potongan_pajak>0 and nominal>0;
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kel_jurnal,kode_dr,referensi) SELECT '1130103' as acc_no,(case when potongan is null then 0 else potongan end) as tx_nominal,'Piutang Dokter No Bukti :'+cast(no_bukti as varchar(255))as tx_uraian,tgl_pembentukan as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,id_bd_tc_hutang_dr as no_jurnal,2 as no_det_jurnal,no_bukti, '17' as kel_jurnal,kode_dokter as kode_dr,no_sppu as referensi FROM bd_tc_hutang_dr WHERE status_ver=0 and potongan>0 and nominal>0;
update bd_tc_hutang_dr set status_ver=1 where status_ver=0 and no_bukti in (select no_bukti from tx_harian where kel_jurnal=17 and tx_tipe='D');

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_fee_dokter_sp");
    }
};
