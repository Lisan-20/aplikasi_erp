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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[lap_SIE_penyakit]

as
DECLARE @Data INT
SET @Data = (select count(bln) from  sie_penyakit where thn=YEAR(GETDATE()));
if(@Data>0)
BEGIN
DELETE  sie_penyakit WHERE bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE())

insert into  sie_penyakit(kode_bagian, kode_kelompok, bln, thn, jml_lama, jml_baru, kode_icd_x, kode_perusahaan)
select kode_bagian,kode_kelompok, bulan,tahun,lama,baru, kode_icd, kode_perusahaan
from lap_penyakit_lama_baru_v where bulan=MONTH(GETDATE()) AND tahun=YEAR(GETDATE());
END

ELSE 

BEGIN
insert into  sie_penyakit(kode_bagian, kode_kelompok, bln, thn, jml_lama, jml_baru, kode_icd_x, kode_perusahaan)
select kode_bagian,kode_kelompok, bulan,tahun,lama,baru, kode_icd, kode_perusahaan
from lap_penyakit_lama_baru_v where bulan=MONTH(GETDATE()) AND tahun=YEAR(GETDATE());
END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_SIE_penyakit");
    }
};
