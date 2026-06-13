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
        DB::unprepared("CREATE proc [dbo].[lap_kunjungan_hemo_new_sp]
@bln as int,
@thn as int,
@bagian as int

as

insert into  lap_kunjungan_hemo_temp(tglnya, blnnya, thnnya, kode_bagian, umum, BpjsPbi, BpjsNonPbi, BpjsKtngkrja, jamkesda, pt, asuransi)
select tgl, @bln as bln, @thn as thn, '050401' as kode_bagian,  umum, BpjsPbi, BpjsNonPbi, BpjsKtngkrja, jamkesda, pt, asuransi
from lap_kunjungan_lab_nasabah_sum_v where bln = @bln and thn = @thn and kode_bagian=@bagian

insert into  lap_kunjungan_pm_tind_temp(kode_tarif, jmlTind, kode_bagian, tgl, bln, thn)
select kode_tarif, JmlTind, '050401' as kode_bagian, tgl, @bln as bln, @thn as thn
from lap_kunjungan_pm_tind_v where bln = @bln and thn = @thn and kode_bagian=@bagian

update lap_kunjungan_pm_hemo_jmlpas_v set ipd=ipd1, opd_dalam=opd_dalam1, opd_luar=opd_luar1 where blnnya = @bln and thnnya = @thn

--update lap_kunjungan_hemo_temp set reuse=ipd1 where blnnya = @bln and thnnya = @thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_hemo_new_sp");
    }
};
