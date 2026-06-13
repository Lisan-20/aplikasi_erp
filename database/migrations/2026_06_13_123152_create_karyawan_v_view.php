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
        DB::statement("CREATE VIEW dbo.karyawan_v
AS
SELECT     dbo.dd_user.username, dbo.mt_karyawan.nama_pegawai, dbo.mt_bagian.nama_bagian, dbo.mt_karyawan.no_induk, dbo.dd_user.ko_wil, 
                      dbo.mt_karyawan.kode_dokter, dbo.mt_karyawan.status AS Expr1, dbo.mt_karyawan.no_mr, dbo.mt_jabatan.nama_jabatan, 
                      dbo.dd_user_group.nama_group
FROM         dbo.dd_user_group INNER JOIN
                      dbo.dd_user ON dbo.dd_user_group.id_dd_user_group = dbo.dd_user.id_dd_user_group RIGHT OUTER JOIN
                      dbo.mt_bagian RIGHT OUTER JOIN
                      dbo.mt_karyawan ON dbo.mt_bagian.kode_bagian = dbo.mt_karyawan.kode_bagian ON 
                      dbo.dd_user.no_induk = dbo.mt_karyawan.no_induk LEFT OUTER JOIN
                      dbo.mt_jabatan ON dbo.mt_karyawan.kode_jabatan = dbo.mt_jabatan.kode_jabatan
WHERE     (dbo.mt_karyawan.kode_dokter IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [karyawan_v]");
    }
};
