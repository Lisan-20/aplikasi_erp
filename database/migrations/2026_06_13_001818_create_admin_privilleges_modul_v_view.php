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
        DB::statement("
CREATE OR ALTER VIEW dbo.admin_privilleges_modul_v
AS
SELECT     dbo.dd_user.username, dbo.dd_group.nama_group, dbo.dc_modul.nama_modul, dbo.dc_modul.id_dc_modul, dbo.dd_user.id_dd_user, 
                      dbo.dd_group_modul.id_dd_group_modul, dbo.dd_group.id_dd_group
FROM         dbo.dd_user INNER JOIN
                      dbo.dd_group_modul ON dbo.dd_user.id_dd_user = dbo.dd_group_modul.id_dd_user INNER JOIN
                      dbo.dc_modul ON dbo.dd_group_modul.id_dc_modul = dbo.dc_modul.id_dc_modul INNER JOIN
                      dbo.dd_group ON dbo.dd_group_modul.hak_akses = dbo.dd_group.id_dd_group

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [admin_privilleges_modul_v]");
    }
};
