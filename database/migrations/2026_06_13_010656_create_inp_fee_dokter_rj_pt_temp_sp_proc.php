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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[inp_fee_dokter_rj_pt_temp_sp]
as
insert into fee_dokter_rj_PT_temp(kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,jumlah)
select kode_dr,no_kunjungan,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,kode_trans_pelayanan,bill_dr1 as jumlah
from inp_fee_dr1_pt_v;

update tc_trans_pelayanan set flag_dr1=1 where kode_trans_pelayanan in (select kode_trans_pelayanan from fee_dokter_rj_PT_temp);
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS inp_fee_dokter_rj_pt_temp_sp");
    }
};
