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
        DB::statement("CREATE OR ALTER VIEW dbo.dd_group_user_detail_new_v
AS
SELECT     dbo.dd_user_group.nama_group, dbo.dc_sub_menu.id_dc_sub_menu, dbo.dc_sub_menu.nama_sub_menu, dbo.dc_menu.id_dc_menu, 
                      dbo.dc_menu.nama_menu, dbo.dc_modul.id_dc_modul, dbo.dc_modul.nama_modul, dbo.dd_group.nama_group AS nama_hak, 
                      dbo.dc_menu.no_urut AS no_menu, dbo.dc_sub_menu.no_urut AS no_submenu, dbo.dc_modul.no_urut AS no_modul, 
                      dbo.dd_user_group_detail.hak_akses_menu, dbo.dd_user_group_detail.id_dd_user_group, dbo.dd_user_group_detail.id_dd_user_group_detail
FROM         dbo.dc_modul LEFT OUTER JOIN
                      dbo.dc_menu LEFT OUTER JOIN
                      dbo.dd_user_group_detail INNER JOIN
                      dbo.dd_user_group ON dbo.dd_user_group_detail.id_dd_user_group = dbo.dd_user_group.id_dd_user_group INNER JOIN
                      dbo.dd_group ON dbo.dd_user_group_detail.hak_akses_menu = dbo.dd_group.id_dd_group RIGHT OUTER JOIN
                      dbo.dc_sub_menu ON dbo.dd_user_group_detail.id_dc_sub_menu = dbo.dc_sub_menu.id_dc_sub_menu ON 
                      dbo.dc_menu.id_dc_menu = dbo.dc_sub_menu.id_dc_menu ON dbo.dc_modul.id_dc_modul = dbo.dc_menu.id_dc_modul
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dd_group_user_detail_new_v]");
    }
};
