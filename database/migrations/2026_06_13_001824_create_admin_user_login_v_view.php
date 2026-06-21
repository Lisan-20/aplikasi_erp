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
        DB::statement("CREATE OR ALTER VIEW dbo.admin_user_login_v
AS
SELECT     dbo.log_user_login.id_log_user, dbo.log_user_login.id_dd_user, dbo.log_user_login.session_id, dbo.log_user_login.login_time, 
                      dbo.log_user_login.ip_address, dbo.dd_user.username, dbo.dd_user.password, dbo.dd_user.npp, dbo.dd_user.ko_wil, 
                      dbo.dc_wilayah_kerja.nawil_kerja, dbo.dd_user.status, dbo.log_user_login.logoff_time, dbo.dc_wilayah_kerja.keterangan, 
                      dbo.dc_wilayah_kerja.alamat, dbo.dc_wilayah_kerja.kota, dbo.dc_wilayah_kerja.propinsi, dbo.dc_wilayah_kerja.kode_pos, 
                      dbo.dc_wilayah_kerja.ket_wil_kerja, dbo.dc_wilayah_kerja.id_dc_wilayah_kerja, dbo.dd_user_group.nama_group
FROM         dbo.dc_wilayah_kerja RIGHT OUTER JOIN
                      dbo.dd_user ON dbo.dc_wilayah_kerja.ko_wil = dbo.dd_user.ko_wil LEFT OUTER JOIN
                      dbo.dd_user_group ON dbo.dd_user.id_dd_user_group = dbo.dd_user_group.id_dd_user_group RIGHT OUTER JOIN
                      dbo.log_user_login ON dbo.dd_user.id_dd_user = dbo.log_user_login.id_dd_user
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [admin_user_login_v]");
    }
};
