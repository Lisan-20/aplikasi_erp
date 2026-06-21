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
        DB::statement("CREATE OR ALTER VIEW dbo.rg_info_ruangan_v
AS
SELECT     dbo.mt_bagian.nama_bagian, dbo.mt_ruangan.kode_bagian, dbo.mt_ruangan.kode_klas, dbo.mt_klas.nama_klas, dbo.mt_ruangan.no_kamar, 
                      dbo.mt_ruangan.no_bed, dbo.mt_ruangan.status, dbo.mt_ruangan.kode_ruangan
FROM         dbo.mt_ruangan INNER JOIN
                      dbo.mt_bagian ON dbo.mt_ruangan.kode_bagian = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_klas ON dbo.mt_ruangan.kode_klas = dbo.mt_klas.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rg_info_ruangan_v]");
    }
};
