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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[lap_kunjungan_vk_new_sp]
@bln as int,
@thn as int,
@bagian as int

as

insert into  lap_kunjungan_ok_tind_temp(kode_tarif, jmlTind, kode_bagian, tgl, bln, thn)
select kode_tarif, JmlTind, '030501' as kode_bagian, tgl, @bln as bln, @thn as thn
from lap_kunjungan_vk_tind_sum_v where bln = @bln and thn = @thn and kode_bagian=@bagian

insert into  lap_kunjungan_vk_temp(tglnya, blnnya, thnnya, kode_bagian, lama, baru)
select tgl, @bln as bln, @thn as thn, '030501' as kode_bagian, lama, baru
from lap_kunjungan_vk_LB_sum_v where bln = @bln and thn = @thn and kode_bagian=@bagian


update lap_kunjungan_vk_nasabah_v set umum=umum1, BpjsPbi=BpjsPbi1, BpjsCob=BpjsCob1, BpjsNonPbi=BpjsNonPbi1, BpjsKtngkrja=BpjsKtngkrja1, jamkesda=jamkesda1, pt=pt1, asuransi=asuransi1 where blnnya = @bln and thnnya = @thn

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_vk_new_sp");
    }
};
