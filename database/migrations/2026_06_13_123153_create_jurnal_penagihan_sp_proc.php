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













CREATE PROC [dbo].[jurnal_penagihan_sp]
AS
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,kode_perusahaan,referensi) SELECT acc_kredit,(jumlah) as tx_nominal,cast('Piutang Usaha Sementara No. Invoice : '+no_invoice_tagih as varchar(255)) as tx_uraian,tgl as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,id_tc_tagih as no_jurnal,'2' as no_det_jurnal,no_invoice_tagih as no_bukti,kode_bagian,petugas as no_induk,'5' as kel_jurnal,kode_perusahaan,no_invoice_tagih as referensi FROM jurnal_penagihan_v WHERE status_ver=0 and acc_kredit>0 ;
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,kode_perusahaan,referensi) SELECT acc_debet,(jumlah - diskon) as tx_nominal,cast('Piutang Usaha No. Invoice : '+no_invoice_tagih as varchar(255)) as tx_uraian,tgl as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,id_tc_tagih as no_jurnal,'1' as no_det_jurnal,no_invoice_tagih as no_bukti,kode_bagian,petugas as no_induk,'5' as kel_jurnal,kode_perusahaan,no_invoice_tagih as referensi FROM jurnal_penagihan_v WHERE status_ver=0 and acc_debet>0 and kode_jenis_proses<>53 ;
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,kode_perusahaan,referensi) SELECT acc_debet,(diskon) as tx_nominal,cast('Diskon Piutang Usaha No. Invoice : '+no_invoice_tagih as varchar(255)) as tx_uraian,tgl as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,id_tc_tagih as no_jurnal,'1' as no_det_jurnal,no_invoice_tagih as no_bukti,kode_bagian,petugas as no_induk,'5' as kel_jurnal,kode_perusahaan,no_invoice_tagih as referensi FROM jurnal_penagihan_v WHERE status_ver=0 and acc_debet>0 and kode_jenis_proses=53 and diskon>0;

update verifikasi_penagihan_v set status_ver=1 where status_ver =0;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_penagihan_sp");
    }
};
