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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[lap_kunjungan_perina]
@bln as int,
@thn as int,
@bagian as int

as

insert into  lap_kunjungan_new_perina_temp(tglnya, blnnya, thnnya, by_skt, by_sht, lama, baru)
select tgl, @bln as bln, @thn as thn,  by_skt, by_sht, lama, baru
from lap_kunjungan_perina_sum_all2_v where bln = @bln and thn = @thn and validasi_lap_rm=@bagian

update lap_kunjungan_perina_jml_pas_klas_v set pas11=pas1, pas31=pas3, pas21=pas2 where bln = @bln and thn = @thn and validasi_lap_rm=@bagian

update lap_kunjungan_perina_aps_all_v set aps31=aps3, aps21=aps2, aps11=aps1 where bln = @bln and thn = @thn and validasi_lap_rm=@bagian

update lap_kunjungan_perina_blpl_all_v set blpl31=blpl3, blpl21=blpl2, blpl11=blpl1 where bln = @bln and thn = @thn and validasi_lap_rm=@bagian

update lap_kunjungan_perina_nasabah_all_v set umum1=umum, BpjsPbi1=BpjsPbi, BpjsNonPbi1=BpjsNonPbi, BpjsKtngkrja1=BpjsKtngkrja, jamkesda1=jamkesda, pt1=pt, asuransi1=asuransi where bln = @bln and thn = @thn and validasi_lap_rm=@bagian

update lap_kunjungan_perina_min48_all_v set min4831=min483, min4821=min482, min4811=min481 where bln = @bln and thn = @thn and validasi_lap_rm=@bagian

update lap_kunjungan_perina_plus48_all_v set plus4831=plus483, plus4821=plus482, plus4811=plus481 where bln = @bln and thn = @thn and validasi_lap_rm=@bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_perina");
    }
};
