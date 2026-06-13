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
        DB::unprepared("CREATE proc [dbo].[lap_kunjungan_lab_new1_sp]
@bln as int,
@thn as int,
@bagian as int

as

truncate table lap_kunjungan_pm_tind_temp;

insert into  lap_kunjungan_pm_tind_temp(kode_tarif, jmlTind, kode_bagian, tgl, bln, thn)
select referensi, JmlTind, '050101' as kode_bagian, tgl, @bln as bln, @thn as thn
from lap_kunjungan_pm_tind_sum_v where bln = @bln and thn = @thn and kode_bagian=@bagian;

update lap_kunjungan_pm_lab_jmlpas_v set ipd=ipd1, opd_dalam=opd_dalam1, opd_luar=opd_luar1 where blnnya = @bln and thnnya = @thn;

--update lap_kunjungan_pm_lab_jmltind_v set kimia=kimia1, hematologi=hematologi1, serologi=serologi1, bakteriologi=bakteriologi1, urinalisa=urinalisa1, feaces=feaces1 where blnnya = @bln and thnnya = @thn

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_lab_new1_sp");
    }
};
