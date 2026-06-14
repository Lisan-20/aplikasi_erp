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
        DB::statement("CREATE OR ALTER VIEW dbo.dc_pendidikan_v
AS
SELECT     dbo.dc_pendidikan.id_dc_pendidikan, dbo.dc_pendidikan.pendidikan, dbo.dc_pendidikan.kd_grup_kualifikasi, dbo.dc_grup_kualifikasi_pend.nama_grup, 
                      dbo.dc_pendidikan.status
FROM         dbo.dc_pendidikan INNER JOIN
                      dbo.dc_grup_kualifikasi_pend ON dbo.dc_pendidikan.kd_grup_kualifikasi = dbo.dc_grup_kualifikasi_pend.kd_grup_kualifikasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dc_pendidikan_v]");
    }
};
