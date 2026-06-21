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
        DB::statement("CREATE OR ALTER VIEW dbo.gd_dd_user
AS
SELECT     dbo.mt_karyawan.nama_pegawai, dbo.dd_user.no_induk, dbo.mt_karyawan.kode_bagian
FROM         dbo.mt_karyawan INNER JOIN
                      dbo.dd_user ON dbo.mt_karyawan.no_induk = dbo.dd_user.no_induk
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [gd_dd_user]");
    }
};
