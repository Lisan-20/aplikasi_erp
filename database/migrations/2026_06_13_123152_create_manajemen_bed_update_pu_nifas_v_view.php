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
        DB::statement("CREATE OR ALTER VIEW dbo.manajemen_bed_update_pu_nifas_v
AS
SELECT     dbo.dhas_ruangan_info.nifas_kode_ruangan, dbo.manajemen_bed_v.status, dbo.dhas_ruangan_info.nifas_status, dbo.manajemen_bed_v.jen_kelamin, dbo.dhas_ruangan_info.nifas_jen_kel, 
                      dbo.manajemen_bed_v.nama_klas, dbo.dhas_ruangan_info.nifas_klas, dbo.dhas_ruangan_info.nifas_bed, dbo.manajemen_bed_v.no_bed
FROM         dbo.dhas_ruangan_info INNER JOIN
                      dbo.manajemen_bed_v ON dbo.dhas_ruangan_info.nifas_kode_ruangan = dbo.manajemen_bed_v.kode_ruangan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [manajemen_bed_update_pu_nifas_v]");
    }
};
