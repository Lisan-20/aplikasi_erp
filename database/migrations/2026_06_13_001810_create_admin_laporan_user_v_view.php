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
        DB::statement("CREATE OR ALTER VIEW dbo.admin_laporan_user_v
AS
SELECT     dbo.dd_user.id_dd_user, dbo.dd_user.username, dbo.dd_user.npp, dbo.dd_user.ko_wil, dbo.dd_user.status, dbo.dc_wilayah_kerja.nawil_kerja, 
                      dbo.dd_user_group.nama_group
FROM         dbo.dd_user LEFT OUTER JOIN
                      dbo.dd_user_group ON dbo.dd_user.id_dd_user_group = dbo.dd_user_group.id_dd_user_group LEFT OUTER JOIN
                      dbo.dc_wilayah_kerja ON dbo.dd_user.ko_wil = dbo.dc_wilayah_kerja.ko_wil
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [admin_laporan_user_v]");
    }
};
