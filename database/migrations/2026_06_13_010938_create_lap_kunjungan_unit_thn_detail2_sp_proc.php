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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[lap_kunjungan_unit_thn_detail2_sp]
@tahun as int,
@kode_perusahaan as int
--@kode_bagian as varchar(6)

as
--jenis kelamin
truncate table laporan_kunjungan_unit_sex_temp;
insert into laporan_kunjungan_unit_sex_temp(kode_bagian, kode_perusahaan, bln, thn, jen_kelamin_up, jen_kelamin)
select kode_bagian, kode_perusahaan, bln, thn, jen_kelamin_up, jen_kelamin
from laporan_kunjungan_unit_sex_sum_v where kode_perusahaan=@kode_perusahaan and thn =@tahun;

update laporan_kunjungan_unit_sex_sum_up_v set laki=jen_kelamin_up where jen_kelamin='L';
update laporan_kunjungan_unit_sex_sum_up_v set wanita=jen_kelamin_up where jen_kelamin='P';

--jenis umur
truncate table laporan_kunjungan_unit_usia_temp;
insert into laporan_kunjungan_unit_usia_temp(kode_bagian, kode_perusahaan, bln, thn, jum_pasien, ket)
select kode_bagian, kode_perusahaan, bln, thn, jum_pasien, ket
from laporan_kunjungan_unit_usia_sum_v where kode_perusahaan=@kode_perusahaan and thn =@tahun;

update laporan_kunjungan_unit_usia_sum_up_v set anak=jum_pasien where ket='ANAK';
update laporan_kunjungan_unit_usia_sum_up_v set dewasa=jum_pasien where ket='DEWASA';
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_kunjungan_unit_thn_detail2_sp");
    }
};
