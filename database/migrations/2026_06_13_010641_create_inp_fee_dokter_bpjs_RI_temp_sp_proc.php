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
        DB::unprepared("CREATE OR ALTER PROCEDURE inp_fee_dokter_bpjs_RI_temp_sp
@kode_trans_pelayanan as int,
@kode_dokter as int,
@no_induk as int
as


insert into fee_dokter_bpjs_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk)
select kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_jam,kode_bagian,nama_tindakan,kode_trans_pelayanan,fee_dokter as jumlah,@no_induk
from tc_fee_dokter_bpjs where kode_trans_pelayanan=@kode_trans_pelayanan and kode_dr=@kode_dokter;

update tc_fee_dokter_bpjs set flag_dr=1 where kode_dr=@kode_dokter and fee_dokter>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_bpjs_temp);
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_fee_dokter_bpjs_RI_temp_sp");
    }
};
