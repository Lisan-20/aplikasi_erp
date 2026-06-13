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
        DB::unprepared("CREATE proc [dbo].[inp_fee_dokter_bedah_bpjs_temp_sp]
@kode_trans_pelayanan as int,
@kode_dokter as int,
@no_induk as int,
@saldo_dokter as int,
@fee_bpjs as int

as
-- pasien umum
insert into fee_dokter_rinap_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah,no_induk,flag_bpjs,kode_kelompok,kode_perusahaan,flag_bedah_bpjs,fee_bpjs)
select kode_dokter1,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_jam,kode_bagian,nama_tindakan,kode_trans_pelayanan,@saldo_dokter as jumlah,@no_induk,'1' as flag_bpjs,kode_kelompok,kode_perusahaan,'1' as flag_bedah_bpjs,@fee_bpjs as fee_bpjs
from bill_dr_bedah_bpjs_v where kode_trans_pelayanan=@kode_trans_pelayanan and kode_dokter1=@kode_dokter;

update tc_trans_pelayanan set flag_dr1=1 where kode_dokter1=@kode_dokter and bill_dr1>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rinap_temp where flag_bpjs=1);
update tc_trans_pelayanan set flag_dr2=1 where kode_dokter2=@kode_dokter and bill_dr2>0 and kode_trans_pelayanan=@kode_trans_pelayanan and kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rinap_temp where flag_bpjs=1);
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_fee_dokter_bedah_bpjs_temp_sp");
    }
};
