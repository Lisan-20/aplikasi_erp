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
        $sql = "
            ALTER VIEW dbo.user_karyawan_v
            AS
            SELECT     dbo.dd_user.id_dd_user, dbo.dd_user.username, dbo.mt_karyawan.nama_pegawai, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.no_induk, 
                                  dbo.dd_user_group.nama_group, dbo.dd_user.id_dd_user_group, dbo.dd_user.status, dbo.dd_user.ko_wil, dbo.mt_karyawan.kode_jabatan, 
                                  dbo.mt_karyawan.status AS status_kary, dbo.mt_karyawan.no_mr, dbo.mt_bagian.kode_bagian, dbo.dd_user.hak_user_sie
            FROM         dbo.dd_user INNER JOIN
                                  dbo.mt_karyawan ON dbo.dd_user.no_induk = dbo.mt_karyawan.no_induk INNER JOIN
                                  dbo.mt_bagian ON dbo.mt_karyawan.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                                  dbo.dd_user_group ON dbo.dd_user.id_dd_user_group = dbo.dd_user_group.id_dd_user_group
        ";
        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not necessary for this fix
    }
};
