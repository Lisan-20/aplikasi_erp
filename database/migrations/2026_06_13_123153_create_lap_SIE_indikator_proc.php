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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[lap_SIE_indikator]

as
DECLARE @Data INT
SET @Data = (select count(bln) from  sie_indikator where thn=YEAR(GETDATE()));
if(@Data>0)
BEGIN
DELETE  sie_indikator WHERE bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE())

insert into  sie_indikator(kode_bagian, kode_kelas, bln, thn, jml_masuk, jml_keluar, jml_hari_rawat, jml_tt_tidur)
select bag_pas, kelas_pas, bln, thn, masuk, keluar, hari_rawat, jml_bed
from v_sie_indikator where bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE());
END

ELSE 

BEGIN
insert into  sie_indikator(kode_bagian, kode_kelas, bln, thn, jml_masuk, jml_keluar, jml_hari_rawat, jml_tt_tidur)
select bag_pas, kelas_pas, bln, thn, masuk, keluar, hari_rawat, jml_bed
from v_sie_indikator where bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE());
END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_SIE_indikator");
    }
};
