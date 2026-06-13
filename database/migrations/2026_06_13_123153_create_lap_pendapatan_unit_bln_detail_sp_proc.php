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
        DB::unprepared("CREATE proc [dbo].[lap_pendapatan_unit_bln_detail_sp]
@bulan as int,
@tahun as int,
@kode_perusahaan as int
--@kode_bagian as varchar(6)

as

insert into laporan_pendapatan_unit_detail_temp(kode_bagian, kode_perusahaan, bln, thn, jumlah, jml_pasien)
select kode_bagian, kode_perusahaan, bln, thn, jumlah, jml_pasien
from lap_kinerja_rs_unit_det2_v where kode_perusahaan=@kode_perusahaan and bln =@bulan and thn =@tahun;

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_pendapatan_unit_bln_detail_sp");
    }
};
