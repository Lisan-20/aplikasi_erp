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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_karyawan_upload_v
AS
SELECT     dbo.mt_karyawan_upload2.Nama, dbo.mt_bagian.kode_bagian, dbo.dc_sex.id_dc_sex, dbo.mt_jabatan.kode_jabatan, dbo.dc_agama.id_dc_agama, dbo.dc_kawin.id_dc_kawin, 
                      dbo.mt_karyawan_upload2.NO, dbo.mt_karyawan_upload2.NIK, dbo.mt_karyawan.npp
FROM         dbo.mt_karyawan_upload2 INNER JOIN
                      dbo.mt_karyawan ON dbo.mt_karyawan_upload2.NO = dbo.mt_karyawan.urutan_karyawan LEFT OUTER JOIN
                      dbo.dc_agama ON dbo.mt_karyawan_upload2.Agama = dbo.dc_agama.agama LEFT OUTER JOIN
                      dbo.mt_jabatan ON dbo.mt_karyawan_upload2.Jabatan = dbo.mt_jabatan.nama_jabatan LEFT OUTER JOIN
                      dbo.mt_bagian ON dbo.mt_karyawan_upload2.[No# ID] = dbo.mt_bagian.nama_bagian LEFT OUTER JOIN
                      dbo.dc_kawin ON dbo.mt_karyawan_upload2.[Status Perkawinan] = dbo.dc_kawin.kawin LEFT OUTER JOIN
                      dbo.dc_sex ON dbo.mt_karyawan_upload2.[Jenis Kelamin] = dbo.dc_sex.sex
WHERE     (NOT (dbo.mt_karyawan_upload2.Nama LIKE N'Admin')) AND (dbo.mt_karyawan.npp IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_karyawan_upload_v]");
    }
};
