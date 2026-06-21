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
        DB::unprepared("CREATE OR ALTER PROCEDURE [dbo].[lap_SIE_dokter]

as
DECLARE @Data INT
SET @Data = (select count(bln) from  sie_dokter where thn=YEAR(GETDATE()));
if(@Data>0)
BEGIN
DELETE  sie_dokter WHERE bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE())

insert into  sie_dokter(kode_bagian, kode_kelompok, bln, thn, jml_lama, jml_baru, kode_dr, kode_perusahaan)
select kode_bagian_tujuan,kode_kelompok,bln,thn,lama,baru, kode_dokter, perusahaan
from sum_kunjungan_pasien_dokter_v where bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE());
END

ELSE 

BEGIN
insert into  sie_dokter(kode_bagian, kode_kelompok, bln, thn, jml_lama, jml_baru, kode_perusahaan, kode_dr)
select kode_bagian_tujuan,kode_kelompok,bln,thn,lama,baru,perusahaan, kode_dokter
from sum_kunjungan_pasien_dokter_v where bln=MONTH(GETDATE()) AND thn=YEAR(GETDATE());
END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS lap_SIE_dokter");
    }
};
