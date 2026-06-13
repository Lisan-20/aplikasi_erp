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
        DB::unprepared("CREATE proc [dbo].[lap_kunjungan_unit_bln_detail_sp]
@bulan as int,
@tahun as int,
@kode_perusahaan as int
--@kode_bagian as varchar(6)

as

insert into laporan_kunjungan_unit_detail_temp(kode_bagian, kode_perusahaan, bln, thn, jml_pasien)
select kode_bagian, kode_perusahaan, bln, thn, jml_pasien
from laporan_kunjungan_unit2_v where kode_perusahaan=@kode_perusahaan and bln =@bulan and thn =@tahun;
--status pasien
update laporan_kunjungan_unit_st_pasien_sum_up_v set lama=jml_lamabaru where stat_pasien='Lama';
update laporan_kunjungan_unit_st_pasien_sum_up_v set baru=jml_lamabaru where stat_pasien='Baru';
--jenis kelamin
update laporan_kunjungan_unit_sex_sum_up_v set laki=jen_kelamin_up where jen_kelamin='L';
update laporan_kunjungan_unit_sex_sum_up_v set wanita=jen_kelamin_up where jen_kelamin='P';

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_unit_bln_detail_sp");
    }
};
