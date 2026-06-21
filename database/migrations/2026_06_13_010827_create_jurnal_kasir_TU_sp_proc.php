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
CREATE OR ALTER PROCEDURE [dbo].[jurnal_kasir_TU_sp]
AS
BEGIN

--kredit
insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,kode_bank,referensi) select acc_kredit as acc_no,jml_tu as tx_nominal,'Pendapatan Lain (Kasir) '+cast(uraian as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,GETDATE() as tx_jam,'K' as tx_tipe,'2' as no_jurnal,'1' as no_det_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian,no_induk,'87' as kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,'0' as kode_bank,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as referensi from tc_kasir_transaksi_umum_v where acc_kredit>0 and flag_jurnal=0;
--debtet
insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,kode_bank,referensi,kd_trans_bendahara,kd_group_trans) select '1110101' as acc_no,tunai as tx_nominal,'Pendapatan Lain (Kasir)  '+cast(uraian as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,GETDATE() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,'2' as no_det_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian,no_induk,'87' as kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,'0' as kode_bank,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as referensi,kd_trans_bendahara, 1 as kd_group_trans  from tc_kasir_transaksi_umum_v where  tunai>0 and flag_jurnal=0;
insert into tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,kode_bank,referensi,kd_trans_bendahara,kd_group_trans) select '1110201' as acc_no,debet as tx_nominal,'Pendapatan Lain (Kasir)  '+cast(uraian as varchar(255)) as tx_uraian,tgl_jam as tx_tgl,GETDATE() as tx_jam,'D' as tx_tipe,'2' as no_jurnal,'3' as no_det_jurnal,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as no_bukti,kode_bagian,no_induk,'87' as kel_jurnal,no_mr,no_registrasi,kode_perusahaan,kode_tc_trans_kasir,'0' as kode_bank,seri_kuitansi+'-'+cast(no_kuitansi as varchar(255)) as referensi,kd_trans_bendahara, 1 as kd_group_trans  from tc_kasir_transaksi_umum_v where  debet>0 and flag_jurnal=0;
update tc_kasir_transaksi_umum_v set flag_jurnal=1 where flag_jurnal=0 and kode_tc_trans_kasir in(select kode_tc_trans_kasir from tc_kasir_transaksi_umum_v where flag_jurnal=0);
--update jurnal_uang_muka_v set flag_jurnal=1 where flag_jurnal=0;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_kasir_TU_sp");
    }
};
