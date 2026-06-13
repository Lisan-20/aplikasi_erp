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
CREATE VIEW dbo.admin_hak_user_v
AS
SELECT     dbo.dd_user_group_detail.id_dd_user_group_detail, dbo.dd_user_group_detail.hak_akses_menu, dbo.dd_group.nama_group, 
                      dbo.dc_sub_menu.nama_sub_menu, dbo.dc_sub_menu.url_sub_menu, dbo.dc_sub_menu.keterangan, 
                      dbo.dc_sub_menu.no_urut AS no_urut_sub_menu, dbo.dc_sub_menu.id_dc_sub_menu, dbo.dc_menu.id_dc_menu, dbo.dc_menu.nama_menu, 
                      dbo.dc_menu.no_urut AS no_urut_menu, dbo.dc_modul.id_dc_modul, dbo.dc_modul.nama_modul, dbo.dc_modul.logo, 
                      dbo.dc_modul.no_urut AS no_urut_modul, dbo.dd_user.id_dd_user, dbo.dd_user.username, dbo.dd_user.password, dbo.dd_user.npp, 
                      dbo.dd_user.status, dbo.dd_user.ko_wil, dbo.dd_user_group.id_dd_user_group, dbo.dd_user_group.nama_group AS nama_group_user, 
                      dbo.dc_modul.id_dc_modular, dbo.dd_user.no_induk, dbo.dc_modular.nama_modular, dbo.dc_modular.no_urut_modular
FROM         dbo.dc_sub_menu INNER JOIN
                      dbo.dd_user_group INNER JOIN
                      dbo.dd_user_group_detail ON dbo.dd_user_group.id_dd_user_group = dbo.dd_user_group_detail.id_dd_user_group ON 
                      dbo.dc_sub_menu.id_dc_sub_menu = dbo.dd_user_group_detail.id_dc_sub_menu INNER JOIN
                      dbo.dc_menu INNER JOIN
                      dbo.dc_modul ON dbo.dc_menu.id_dc_modul = dbo.dc_modul.id_dc_modul ON dbo.dc_sub_menu.id_dc_menu = dbo.dc_menu.id_dc_menu INNER JOIN
                      dbo.dd_group ON dbo.dd_user_group_detail.hak_akses_menu = dbo.dd_group.id_dd_group INNER JOIN
                      dbo.dd_user ON dbo.dd_user_group.id_dd_user_group = dbo.dd_user.id_dd_user_group LEFT OUTER JOIN
                      dbo.dc_modular ON dbo.dc_modul.id_dc_modular = dbo.dc_modular.id_dc_modular

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [admin_hak_user_v]");
    }
};
