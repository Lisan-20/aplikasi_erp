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
        DB::unprepared("CREATE proc [dbo].[jurnal_pj_umd_sp]
as
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,kode_dr,kode_supplier,referensi,kode_perusahaan) SELECT acc_no_2 as acc_no,(jumlah_transaksi) as tx_nominal,cast(keterangan as varchar(255)) as tx_uraian,tgl_transaksi as tx_tgl,getdate() as tx_jam,'D' as tx_tipe,id_trans_pj_umd as no_jurnal,2 as no_det_jurnal,no_bukti, kode_bagian,inp_id,'22' as kel_jurnal,kode_dr,kode_supplier as kode_supplier,no_bukti as referensi,kode_perusahaan FROM jurnal_pj_umd_2_v WHERE flag_ver=0 and tgl_ver is not null and selisih=0;
INSERT INTO tx_harian(acc_no,tx_nominal,tx_uraian,tx_tgl,tx_jam,tx_tipe,no_jurnal,no_det_jurnal,no_bukti,kode_bagian,no_induk,kel_jurnal,kode_dr,kode_supplier,referensi,kode_perusahaan) SELECT acc_no_1 as acc_no,(jumlah_umd) as tx_nominal,cast(keterangan as varchar(255)) as tx_uraian,tgl_transaksi as tx_tgl,getdate() as tx_jam,'K' as tx_tipe,id_trans_pj_umd as no_jurnal,1 as no_det_jurnal,no_bukti, kode_bagian,inp_id,'22' as kel_jurnal,kode_dr,kode_supplier as kode_supplier,no_bukti as referensi,kode_perusahaan FROM jurnal_pj_umd_2_v WHERE flag_ver=0 and tgl_ver is not null and selisih=0;

update jurnal_pj_umd_2_v set flag_ver=1 where flag_ver=0 and no_bukti in (select no_bukti from tx_harian where kel_jurnal=22 and tx_tipe='K');");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS jurnal_pj_umd_sp");
    }
};
