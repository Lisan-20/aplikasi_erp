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
        DB::unprepared("CREATE proc [dbo].[inp_insentif_bpjs_RI_temp_sp]
@id_tc_fee_dokter as int,
@kode_dokter as int,
@no_induk as int
as


insert into fee_dokter_bpjs_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,id_tc_fee_dokter,jumlah,no_induk)
select kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_jam,kode_bagian,nama_tindakan,id_tc_fee_dokter,fee_dokter as jumlah,@no_induk
from tc_fee_dokter_bpjs where id_tc_fee_dokter=@id_tc_fee_dokter and kode_dr=@kode_dokter;

update tc_fee_dokter_bpjs set flag_dr=1 where kode_dr=@kode_dokter and fee_dokter>0 and id_tc_fee_dokter=@id_tc_fee_dokter and id_tc_fee_dokter in (select id_tc_fee_dokter from fee_dokter_bpjs_temp);
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_insentif_bpjs_RI_temp_sp");
    }
};
