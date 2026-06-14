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
CREATE OR ALTER VIEW dbo.admin_user_login_detail_v
AS
SELECT     dbo.dd_user.username, dbo.log_user_login_detail.id_log_user_login_detail, dbo.log_user_login_detail.id_log_user, 
                      dbo.log_user_login_detail.login_time_detail, dbo.log_user_login_detail.id_dc_modul, dbo.log_user_login_detail.id_dc_menu, 
                      dbo.log_user_login_detail.id_dc_sub_menu, dbo.log_user_login_detail.hak_akses, dbo.log_user_login_detail.status, dbo.dc_menu.nama_menu, 
                      dbo.dc_sub_menu.nama_sub_menu, dbo.dc_modul.nama_modul
FROM         dbo.dc_modul INNER JOIN
                      dbo.dc_menu INNER JOIN
                      dbo.log_user_login_detail ON dbo.dc_menu.id_dc_menu = dbo.log_user_login_detail.id_dc_menu INNER JOIN
                      dbo.dc_sub_menu ON dbo.log_user_login_detail.id_dc_sub_menu = dbo.dc_sub_menu.id_dc_sub_menu ON 
                      dbo.dc_modul.id_dc_modul = dbo.log_user_login_detail.id_dc_modul LEFT OUTER JOIN
                      dbo.dd_user RIGHT OUTER JOIN
                      dbo.log_user_login ON dbo.dd_user.id_dd_user = dbo.log_user_login.id_dd_user ON 
                      dbo.log_user_login_detail.id_log_user = dbo.log_user_login.id_log_user

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [admin_user_login_detail_v]");
    }
};
