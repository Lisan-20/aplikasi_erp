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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_tim_kredensial_v
AS
SELECT     dbo.mt_tim_kredensialing.npp AS npp_tim, dbo.mt_karyawan.nama_pegawai, dbo.mt_tim_kredensialing.st_aktif, dbo.mt_karyawan.status, dbo.mt_tim_kredensialing.Jab_tim
FROM         dbo.mt_tim_kredensialing INNER JOIN
                      dbo.mt_karyawan ON dbo.mt_tim_kredensialing.npp = dbo.mt_karyawan.npp
WHERE     (dbo.mt_tim_kredensialing.st_aktif IS NULL) AND (dbo.mt_karyawan.status = '0')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tim_kredensial_v]");
    }
};
