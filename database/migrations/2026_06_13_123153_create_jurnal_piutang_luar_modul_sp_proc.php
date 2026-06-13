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













CREATE OR ALTER PROCEDURE [dbo].[jurnal_piutang_luar_modul_sp]
AS
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,kode_perusahaan,referensi) SELECT ACC_K,(jumlah_transaksi) as tx_nominal,cast('Piutang Usaha pada Kredit No. Invoice : '+no_bukti as varchar(255)) as tx_uraian,tgl as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,id_trans_piutang as no_jurnal,'2' as no_det_jurnal,no_bukti,kode_bagian,no_induk,'10' as kel_jurnal,kode_perusahaan,no_bukti as referensi FROM jurnal_piutang_luar_modul_v WHERE flag_ver=0;
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,kode_perusahaan,referensi) SELECT ACC_D,(jumlah_transaksi) as tx_nominal,cast('Piutang Usaha Sementara pada Debet No. Invoice : '+no_bukti as varchar(255)) as tx_uraian,tgl as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,id_trans_piutang as no_jurnal,'1' as no_det_jurnal,no_bukti,kode_bagian,no_induk,'10' as kel_jurnal,kode_perusahaan,no_bukti as referensi FROM jurnal_piutang_luar_modul_v WHERE flag_ver=0;

update jurnal_piutang_luar_modul_v set flag_ver=1 where flag_ver =0;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_piutang_luar_modul_sp");
    }
};
