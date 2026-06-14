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
CREATE OR ALTER VIEW dbo.admin_privilleges_user_v
AS
SELECT     dbo.dd_user.username, dbo.dd_group.nama_group, dbo.dc_modul.nama_modul, dbo.dc_menu.nama_menu, dbo.dc_menu.id_dc_menu, 
                      dbo.dc_modul.id_dc_modul, dbo.dd_user.id_dd_user, dbo.dc_sub_menu.nama_sub_menu, dbo.dd_group_menu.id_dd_group_menu, 
                      dbo.dd_group_modul.id_dd_group_modul, dbo.dd_group.id_dd_group
FROM         dbo.dd_group_menu INNER JOIN
                      dbo.dd_user ON dbo.dd_group_menu.id_dd_user = dbo.dd_user.id_dd_user INNER JOIN
                      dbo.dd_group_modul ON dbo.dd_user.id_dd_user = dbo.dd_group_modul.id_dd_user INNER JOIN
                      dbo.dc_menu ON dbo.dd_group_menu.id_dc_menu = dbo.dc_menu.id_dc_menu INNER JOIN
                      dbo.dc_modul ON dbo.dd_group_modul.id_dc_modul = dbo.dc_modul.id_dc_modul AND 
                      dbo.dc_menu.id_dc_modul = dbo.dc_modul.id_dc_modul INNER JOIN
                      dbo.dc_sub_menu ON dbo.dc_menu.id_dc_menu = dbo.dc_sub_menu.id_dc_menu INNER JOIN
                      dbo.dd_group ON dbo.dd_group_menu.hak_akses = dbo.dd_group.id_dd_group

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [admin_privilleges_user_v]");
    }
};
