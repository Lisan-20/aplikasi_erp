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
        DB::statement("CREATE OR ALTER VIEW dbo.info_ruangan_group_v
AS
SELECT     dbo.mt_klas.nama_klas, dbo.mt_ruangan.status, dbo.mt_ruangan.kode_klas, dbo.mt_ruangan.kode_bagian, dbo.mt_bagian.nama_bagian, 1 AS urutan, 
                      dbo.mt_klas.kode_klas_bpjs
FROM         dbo.mt_bagian INNER JOIN
                      dbo.mt_ruangan ON dbo.mt_bagian.kode_bagian = dbo.mt_ruangan.kode_bagian INNER JOIN
                      dbo.mt_klas ON dbo.mt_ruangan.kode_klas = dbo.mt_klas.kode_klas
GROUP BY dbo.mt_klas.nama_klas, dbo.mt_ruangan.status, dbo.mt_ruangan.kode_klas, dbo.mt_ruangan.kode_bagian, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_ruangan.kode_ruangan, dbo.mt_klas.kode_klas_bpjs
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [info_ruangan_group_v]");
    }
};
