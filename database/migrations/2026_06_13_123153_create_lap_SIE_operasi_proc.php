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
        DB::unprepared("CREATE proc [dbo].[lap_SIE_operasi]

as
DECLARE @Data INT
SET @Data = (select count(bln) from  sie_operasi where thn=YEAR(GETDATE()));
if(@Data>0)
BEGIN
DELETE  sie_operasi WHERE bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE())

insert into  sie_operasi(kode_bagian, kode_kelas, bln, thn, kode_kelompok, jenis_operasi, jml_operasi, kode_perusahaan)
select kode_bagian,kode_klas, bln, thn, kode_kelompok, kode_tarif, jml_pasien, kode_perusahaan
from sum_kunjungan_bedah_op_v where bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE());
END

ELSE 

BEGIN
insert into  sie_operasi(kode_bagian, kode_kelas, bln, thn, kode_kelompok, jenis_operasi, jml_operasi, kode_perusahaan)
select kode_bagian,kode_klas, bln, thn, kode_kelompok, kode_tarif, jml_pasien, kode_perusahaan
from sum_kunjungan_bedah_op_v where bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE());
END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_SIE_operasi");
    }
};
