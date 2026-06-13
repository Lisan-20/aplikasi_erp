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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[lap_SIE_partus]

as
DECLARE @Data INT
SET @Data = (select count(bln) from  sie_partus where thn=YEAR(GETDATE()));
if(@Data>0)
BEGIN
DELETE  sie_partus WHERE bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE())

insert into  sie_partus(kode_bagian, kode_kelompok, bln, thn, jenis_partus, jml_partus, kode_perusahaan)
select kode_bagian,kode_kelompok, bulan, tahun, kode_tarif, jumlah, kode_perusahaan
from lap_jml_partus_v where bulan=MONTH(GETDATE()) AND tahun=YEAR(GETDATE());
END

ELSE 

BEGIN
insert into  sie_partus(kode_bagian, kode_kelompok, bln, thn, jenis_partus, jml_partus, kode_perusahaan)
select kode_bagian,kode_kelompok, bulan,tahun, kode_tarif, jumlah, kode_perusahaan
from lap_jml_partus_v where bulan=MONTH(GETDATE()) AND tahun=YEAR(GETDATE());
END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_SIE_partus");
    }
};
