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
        DB::unprepared("CREATE proc [dbo].[fee_billing_dokter_khusus_temp_sp]
@kode_tc_trans_kasir as int,
@kode_dokter as int,
@no_induk as int

as
-- input ke tabel 

insert into fee_dokter_rajal_temp(kode_dr,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_transaksi,tgl_kuitansi,kode_bagian,nama_tindakan,jumlah,no_induk,flag_billing_dr,kode_kelompok,kode_tc_trans_kasir)
select kode_dokter1,no_registrasi,no_mr,seri_kuitansi,no_kuitansi,tgl_jam,tgl_jam,kode_bagian,'Tindakan RJ' as nama_tarif,fee ,@no_induk,'1' as flag_billing_dr,kode_kelompok,kode_tc_trans_kasir
from v_billing_dr_fee where kode_tc_trans_kasir=@kode_tc_trans_kasir and kode_dokter1=@kode_dokter;

update tc_trans_kasir set flag_fee_billing_dr=1 where kode_tc_trans_kasir=@kode_tc_trans_kasir;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS fee_billing_dokter_khusus_temp_sp");
    }
};
