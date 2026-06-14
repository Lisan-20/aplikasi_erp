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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[lap_kunjungan_far_new_sp]
@bln as int,
@thn as int

as

insert into  lap_kunjungan_far_temp(tglnya, blnnya, thnnya, ipd_BpjsPbi)
select tgl, @bln as bln, @thn as thn, jumlah
from lap_rekap_resep_v where bln = @bln and thn = @thn and kode_profit = 1000 and nasabah = 9; -- ini ranap pbi


update lap_rekap_resep4_v set racikan=racik, non_racikan=non_racik where blnnya = @bln and thnnya = @thn;
update lap_rekap_resep5_v set resep_luar=luar, obat_bebas=bebas, obat_karyawan=karyawan where blnnya = @bln and thnnya = @thn;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_far_new_sp");
    }
};
