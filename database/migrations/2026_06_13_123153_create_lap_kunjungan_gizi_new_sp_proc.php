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
        DB::unprepared("CREATE proc [dbo].[lap_kunjungan_gizi_new_sp]
@disribusi as varchar,
@bln as int,
@thn as int

as

insert into  lap_kunjungan_gizi_temp(tgl, bln, thn, umum, bpjs_pbi, bpjs_nonpbi, Bpjs_Ktngkrja, jamkesda, perusahaan, asuransi_lain, bpjs_cob, distribusi)
select tgl, @bln as bln, @thn as thn, umum, BpjsPbi, BpjsNonPbi, BpjsKtngkrja, jamkesda, pt, asuransi, bpjscob, distribusi
from lap_kunjungan_gizi_nasabah_sum_v where bln = @bln and thn = @thn 

insert into rekap_jml_diet_temp(tgl, bln, thn, jns_diet, jumlah)
select tgl, bln, thn, jns_diet, jumlah
from rekap_jml_diet_v where bln = @bln and thn = @thn

update lap_kunjungan_update_kelas_sum_v set kelas_vvip=vvip, kelas_vip=vip, kelasI=kelas_I, kelasII=kelas_II, kelasIII=kelas_III where bln = @bln and thn = @thn
update tc_jumlah_lap_update_gizi_view set ank=anak, dws=dewasa where bln = @bln and thn = @thn

--update lap_kunjungan_pm_lab_jmltind_v set kimia=kimia1, hematologi=hematologi1, serologi=serologi1, bakteriologi=bakteriologi1, urinalisa=urinalisa1, feaces=feaces1 where blnnya = @bln and thnnya = @thn");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_gizi_new_sp");
    }
};
