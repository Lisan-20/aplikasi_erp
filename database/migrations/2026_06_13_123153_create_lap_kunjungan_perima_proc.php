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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[lap_kunjungan_perima]
@bln as int,
@thn as int,
@bagian as int

as

insert into  lap_kunjungan_new_temp(tglnya, blnnya, thnnya, ank_laki, ank_prmp, dws_laki, dws_prmp, lama, baru)
select tgl, @bln as bln, @thn as thn,  ank_laki, ank_prmp, dws_laki, dws_prmp, lama, baru
from lap_kunjungan_sum_all_v where bln = @bln and thn = @thn and validasi_lap_rm=@bagian

update lap_kunjungan_jml_pas_klas_v set pas11=pas1, pas31=pas3, pas2a1=pas2a, pasvip1=pasvip, pasvvip1=pasvvip where bln = @bln and thn = @thn and validasi_lap_rm=@bagian

update lap_kunjungan_aps_all_v set aps31=aps3, aps2a=aps2, aps11=aps1, apsvip1=apsvip, apsvvip1=apsvvip where bln = @bln and thn = @thn and validasi_lap_rm=@bagian

update lap_kunjungan_blpl_all_v set blpl31=blpl3, blpl2a1=blpl2, blpl11=blpl1, blplvip1=blplvip, blplvvip1=blplvvip where bln = @bln and thn = @thn and validasi_lap_rm=@bagian

update lap_kunjungan_nasabah_all_v set umum1=umum, BpjsPbi1=BpjsPbi, BpjsNonPbi1=BpjsNonPbi, BpjsKtngkrja1=BpjsKtngkrja, jamkesda1=jamkesda, pt1=pt, asuransi1=asuransi where bln = @bln and thn = @thn and validasi_lap_rm=@bagian

update lap_kunjungan_min48_all_v set min48vvip1=min48vvip, min48vip1=min48vip, min4831=min483, min482a1=min482a, min4811=min481 where bln = @bln and thn = @thn and validasi_lap_rm=@bagian

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_perima");
    }
};
