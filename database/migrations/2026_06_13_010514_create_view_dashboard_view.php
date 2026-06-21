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
        DB::statement("CREATE OR ALTER VIEW dbo.view_dashboard
AS
SELECT     dbo.mt_ruangan.kode_bagian, dbo.mt_ruangan.kode_klas, dbo.mt_ruangan.status, dbo.mt_ruangan.kode_klas_bpjs, dbo.mt_klas.nama_klas, dbo.mt_ruangan.no_kamar, 
                      dbo.mt_bagian.nama_bagian, dbo.mt_ruangan.keterangan, CAST(dbo.mt_bagian.nama_bagian + ' ' + dbo.mt_ruangan.keterangan AS varchar) AS ruangan, dbo.mt_ruangan.flag_aktif
FROM         dbo.mt_ruangan INNER JOIN
                      dbo.mt_klas ON dbo.mt_ruangan.kode_klas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.mt_bagian ON dbo.mt_ruangan.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (dbo.mt_ruangan.no_kamar NOT IN ('ODC', 'Bayi')) AND (dbo.mt_ruangan.flag_aktif IS NULL OR
                      dbo.mt_ruangan.flag_aktif <> 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [view_dashboard]");
    }
};
