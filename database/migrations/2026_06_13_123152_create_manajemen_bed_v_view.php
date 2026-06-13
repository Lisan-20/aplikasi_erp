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
        DB::statement("CREATE VIEW dbo.manajemen_bed_v
AS
SELECT     dbo.mt_bagian.nama_bagian, dbo.mt_ruangan.kode_ruangan, dbo.mt_bagian.kode_depo_bag, dbo.mt_ruangan.status, dbo.ri_cari_pasien_v.jen_kelamin, dbo.mt_klas.nama_klas, 
                      dbo.mt_ruangan.no_bed
FROM         dbo.mt_ruangan INNER JOIN
                      dbo.mt_bagian ON dbo.mt_ruangan.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_klas ON dbo.mt_ruangan.kode_klas = dbo.mt_klas.kode_klas LEFT OUTER JOIN
                      dbo.ri_cari_pasien_v ON dbo.mt_ruangan.kode_ruangan = dbo.ri_cari_pasien_v.kode_ruangan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [manajemen_bed_v]");
    }
};
