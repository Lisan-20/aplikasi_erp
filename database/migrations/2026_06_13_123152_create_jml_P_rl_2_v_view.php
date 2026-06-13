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
CREATE VIEW [dbo].[jml_P_rl_2_v]
AS
SELECT     dbo.dc_pendidikan_v.nama_grup, COUNT(dbo.dc_riwayat_pendidikan.npp) AS jml_P, dbo.mt_karyawan.id_sex, dbo.dc_pendidikan_v.kd_grup_kualifikasi, dbo.dc_pendidikan_v.pendidikan, 
                      dbo.dc_pendidikan_v.id_dc_pendidikan
FROM         dbo.dc_riwayat_pendidikan INNER JOIN
                      dbo.dc_pendidikan_v ON dbo.dc_riwayat_pendidikan.id_dc_pendidikan = dbo.dc_pendidikan_v.id_dc_pendidikan INNER JOIN
                      dbo.mt_karyawan ON dbo.dc_riwayat_pendidikan.npp = dbo.mt_karyawan.npp
GROUP BY dbo.dc_pendidikan_v.nama_grup, dbo.mt_karyawan.id_sex, dbo.dc_pendidikan_v.kd_grup_kualifikasi, dbo.dc_pendidikan_v.pendidikan, dbo.dc_pendidikan_v.id_dc_pendidikan
HAVING      (dbo.mt_karyawan.id_sex = 2)

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jml_P_rl_2_v]");
    }
};
