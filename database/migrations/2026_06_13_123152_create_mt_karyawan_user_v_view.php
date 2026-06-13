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
        DB::statement("CREATE VIEW dbo.mt_karyawan_user_v
AS
SELECT     dbo.dd_user.id_dd_user, dbo.mt_karyawan.nama_pegawai, dbo.dd_user.npp, dbo.dd_user.no_induk, dbo.dd_user.ko_wil, dbo.dd_user.username, 
                      dbo.mt_karyawan.npp AS npp_real
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.dd_user ON dbo.mt_karyawan.no_induk = dbo.dd_user.no_induk
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_karyawan_user_v]");
    }
};
