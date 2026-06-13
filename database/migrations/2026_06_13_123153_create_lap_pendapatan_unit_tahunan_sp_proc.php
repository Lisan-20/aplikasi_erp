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
        DB::unprepared("create proc [dbo].[lap_pendapatan_unit_tahunan_sp]

@thn as int
--@kode_kelompok as int,
--@kode_bagian as varchar(6)

as

insert into  laporan_pendapatan_unit_temp(kode_bagian, kode_kelompok, thn, jumlah, jml_pasien)
select kode_bagian, kode_kelompok, @thn as thn, sum(jumlah) as jumlah, sum(jml_pasien) as jml_pasien
from lap_kinerja_rs_unit_det_v where  thn = @thn
group by kode_bagian, kode_kelompok, thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_pendapatan_unit_tahunan_sp");
    }
};
