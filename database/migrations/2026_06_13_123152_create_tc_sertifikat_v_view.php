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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_sertifikat_v
AS
SELECT     dbo.mt_penyelenggara_diklat.nama_penyelenggaran, dbo.tc_sertifikat.id_tc_sertifikat, dbo.tc_sertifikat.npp, dbo.tc_sertifikat.nama_kegiatan, dbo.tc_sertifikat.tgl_kegiatan, dbo.tc_sertifikat.id_int, 
                      dbo.tc_sertifikat.nama_file, dbo.tc_sertifikat.id_pen, dbo.tc_sertifikat.lokasi, dbo.tc_sertifikat.durasi, dbo.tc_sertifikat.skp, dbo.tc_sertifikat.komp_didapat
FROM         dbo.tc_sertifikat INNER JOIN
                      dbo.mt_penyelenggara_diklat ON dbo.tc_sertifikat.id_pen = dbo.mt_penyelenggara_diklat.id_pen
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_sertifikat_v]");
    }
};
