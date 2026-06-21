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
CREATE OR ALTER VIEW dbo.admin_laporan_user_privilleges_v
AS
SELECT     dbo.dd_user_group.nama_group, dbo.dd_user_group.id_dd_user_group, dbo.dd_user_group_detail.hak_akses_menu, 
                      dbo.dd_group.nama_group AS hak_akses, dbo.dc_modul.id_dc_modul, dbo.dc_modul.nama_modul, dbo.dc_menu.id_dc_menu, 
                      dbo.dc_menu.nama_menu, dbo.dc_sub_menu.id_dc_sub_menu, dbo.dc_sub_menu.nama_sub_menu, dbo.dc_sub_menu.keterangan
FROM         dbo.dc_menu INNER JOIN
                      dbo.dc_modul ON dbo.dc_menu.id_dc_modul = dbo.dc_modul.id_dc_modul INNER JOIN
                      dbo.dd_user_group INNER JOIN
                      dbo.dd_user_group_detail ON dbo.dd_user_group.id_dd_user_group = dbo.dd_user_group_detail.id_dd_user_group INNER JOIN
                      dbo.dc_sub_menu ON dbo.dd_user_group_detail.id_dc_sub_menu = dbo.dc_sub_menu.id_dc_sub_menu INNER JOIN
                      dbo.dd_group ON dbo.dd_user_group_detail.hak_akses_menu = dbo.dd_group.id_dd_group ON 
                      dbo.dc_menu.id_dc_menu = dbo.dc_sub_menu.id_dc_menu

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [admin_laporan_user_privilleges_v]");
    }
};
