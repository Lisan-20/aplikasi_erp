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
        DB::unprepared("CREATE proc [dbo].[lap_SIE_rujukan]

as
DECLARE @Data INT
SET @Data = (select count(bln) from  sie_rujukan where thn=YEAR(GETDATE()));
if(@Data>0)
BEGIN
DELETE  sie_rujukan WHERE bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE())

insert into  sie_rujukan(kode_bagian, kode_kelompok, bln, thn, jml_lama, jml_baru,id_dc_asal_pasien, kode_perusahaan)
select kode_bagian,kode_kelompok, bln,thn,lama,baru, id_dc_asal_pasien, kode_perusahaan
from lap_rujuk_baru_lama_sum_v where bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE());
END

ELSE 

BEGIN
insert into  sie_rujukan(kode_bagian, kode_kelompok, bln, thn, jml_lama, jml_baru,id_dc_asal_pasien, kode_perusahaan)
select kode_bagian,kode_kelompok, bln,thn,lama,baru, id_dc_asal_pasien, kode_perusahaan
from lap_rujuk_baru_lama_sum_v where bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE());
END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_SIE_rujukan");
    }
};
