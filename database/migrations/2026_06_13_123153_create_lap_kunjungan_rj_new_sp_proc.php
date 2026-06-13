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
        DB::unprepared("CREATE proc [dbo].[lap_kunjungan_rj_new_sp]
@bln as int,
@thn as int

as

insert into  lap_rj_new(tglnya, blnnya, thnnya, ank_laki, ank_prmp, dws_laki, dws_prmp,  lama_dws, baru_dws, lama_anak, baru_anak)
select tgl, @bln as bln, @thn as thn,  ank_laki, ank_prmp, dws_laki, dws_prmp, lama, baru, lama_anak, baru_anak
from lap_kunjungan_rajal_sum_all_v where bln = @bln and thn = @thn

insert into  lap_rj_bagian_new(kode_bagian, jmlPas, tgl, bln, thn)
select kode_bagian, jmlPas, tgl, @bln as bln, @thn as thn
from lap_kunjungan_rajal_bagian_all_v where bln = @bln and thn = @thn

update lap_kunjungan_rajal_nasabah_all_v set umum1=umum, BpjsPbi1=BpjsPbi, BpjsNonPbi1=BpjsNonPbi, BpjsKtngkrja1=BpjsKtngkrja, jamkesda1=jamkesda, pt1=pt, asuransi1=asuransi  where bln = @bln and thn = @thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_rj_new_sp");
    }
};
