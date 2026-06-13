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
        DB::unprepared("CREATE proc [dbo].[lap_SIE_kunjungan]

as
DECLARE @Data INT
SET @Data = (select count(bln) from sie_kunjungan where thn=YEAR(GETDATE()));
if(@Data>0)
BEGIN
DELETE sie_kunjungan WHERE bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE())

insert into sie_kunjungan(kode_bagian, kode_kelompok, bln, thn, jml_lama, jml_baru, kode_perusahaan)
select kode_bagian_tujuan,kode_kelompok,bln,thn,lama,baru, perusahaan
from sum_kunjungan_pasien_lama_baru_v where bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE());
END

ELSE 

BEGIN
insert into sie_kunjungan(kode_bagian, kode_kelompok, bln, thn, jml_lama, jml_baru, kode_perusahaan)
select kode_bagian_tujuan,kode_kelompok,bln,thn,lama,baru,perusahaan
from sum_kunjungan_pasien_lama_baru_v where bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE());
END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_SIE_kunjungan");
    }
};
