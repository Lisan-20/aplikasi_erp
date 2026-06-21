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
        DB::statement("CREATE OR ALTER VIEW dbo.dc_riwayat_pendidikan_v
AS
SELECT     dbo.dc_riwayat_pendidikan.id_riwayat_pendidikan, dbo.dc_riwayat_pendidikan.id_dc_pendidikan, dbo.dc_riwayat_pendidikan.npp, dbo.dc_pendidikan.pendidikan
FROM         dbo.dc_pendidikan INNER JOIN
                      dbo.dc_riwayat_pendidikan ON dbo.dc_pendidikan.id_dc_pendidikan = dbo.dc_riwayat_pendidikan.id_dc_pendidikan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dc_riwayat_pendidikan_v]");
    }
};
