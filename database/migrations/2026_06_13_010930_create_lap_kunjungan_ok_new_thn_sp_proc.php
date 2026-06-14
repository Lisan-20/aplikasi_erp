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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[lap_kunjungan_ok_new_thn_sp]

@thn as int,
@bagian as int

as
truncate table lap_kunjungan_ok_temp;
truncate table lap_kunjungan_ok_tind_temp;

insert into  lap_kunjungan_ok_tind_temp(kode_tarif, jmlTind, kode_bagian, tgl, bln, thn)
select kode_tarif, JmlTind, '030901' as kode_bagian, tgl, bln, @thn as thn
from lap_kunjungan_ok_tind_sum_v where thn = @thn and kode_bagian=@bagian

insert into  lap_kunjungan_ok_temp(tglnya, blnnya, thnnya, kode_bagian, kecil, sedang, besar, besar_khusus)
select tgl, bln, @thn as thn, '030901' as kode_bagian, kecil, sedang, besar, besar_khusus
from lap_kunjungan_ok_gol_sum_v where thn = @thn and kode_bagian=@bagian


update lap_kunjungan_ok_nasabah_v set umum=umum1, BpjsPbi=BpjsPbi1, BpjsCob=BpjsCob1, BpjsNonPbi=BpjsNonPbi1, BpjsKtngkrja=BpjsKtngkrja1, jamkesda=jamkesda1, pt=pt1, asuransi=asuransi1 where thnnya = @thn

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_ok_new_thn_sp");
    }
};
