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
        DB::unprepared("CREATE proc [dbo].[lap_kunjungan_fis_new_sp]
@bln as int,
@thn as int,
@bagian as int

as

insert into  lap_kunjungan_fis_temp(tglnya, blnnya, thnnya, umum, BpjsPbi, BpjsNonPbi, BpjsKtngkrja, jamkesda, pt, asuransi)
select tgl, @bln as bln, @thn as thn,  umum, BpjsPbi, BpjsNonPbi, BpjsKtngkrja, jamkesda, pt, asuransi
from lap_kunjungan_lab_nasabah_sum_v where bln = @bln and thn = @thn and kode_bagian=@bagian

insert into  lap_kunjungan_pm_tind_temp(kode_tarif, jmlTind, kode_bagian, tgl, bln, thn)
select kode_tarif, JmlTind, '050301' as kode_bagian, tgl, @bln as bln, @thn as thn
from lap_kunjungan_pm_tind_v where bln = @bln and thn = @thn and kode_bagian=@bagian

update lap_kunjungan_pm_fis_jmlpas_v set ipd=ipd1, opd_dalam=opd_dalam1, opd_luar=opd_luar1 where blnnya = @bln and thnnya = @thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_fis_new_sp");
    }
};
