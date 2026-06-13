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
        DB::unprepared("CREATE proc [dbo].[lap_kunjungan_igd_new_sp]
@bln as int,
@thn as int

as

insert into  lap_kunjungan_igd_new_temp(tglnya, blnnya, thnnya, lama, baru)
select tgl, @bln as bln, @thn as thn, lama, baru
from lap_kunjungan_igd_BL_v where bln = @bln and thn = @thn

update lap_kunjungan_igd_LP_all_v set ank_laki=ank_laki1, ank_prmp=ank_prmp1, dws_laki=dws_laki1, dws_prmp=dws_prmp1 where blnnya = @bln and thnnya = @thn

update lap_kunjungan_igd_nasabah_v set umum=umum1, BpjsPbi=BpjsPbi1, BpjsCob=BpjsCob1, BpjsNonPbi=BpjsNonPbi1, BpjsKtngkrja=BpjsKtngkrja1, jamkesda=jamkesda1, pt=pt1, asuransi=asuransi1  where blnnya = @bln and thnnya = @thn

update triase_all_v set tri_hijau=hijau, tri_kuning=kuning, tri_merah=merah, tri_hitam=hitam where blnnya = @bln and thnnya = @thn

update outPasien_RI_v set ri_celaka=kecelakaan, ri_Ncelaka=nonKecelakaan where blnnya = @bln and thnnya = @thn

update outPasien_RJ_v set rj_celaka=kecelakaan, rj_Ncelaka=nonKecelakaan where blnnya = @bln and thnnya = @thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_igd_new_sp");
    }
};
