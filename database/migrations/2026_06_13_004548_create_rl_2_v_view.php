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
        DB::statement("CREATE OR ALTER VIEW dbo.rl_2_v
AS
SELECT     TOP (100) PERCENT dbo.dc_pendidikan_v.kd_grup_kualifikasi, dbo.dc_pendidikan_v.id_dc_pendidikan, dbo.dc_pendidikan_v.nama_grup, dbo.dc_pendidikan_v.pendidikan, 
                      CASE WHEN jml_L IS NULL THEN 0 ELSE jml_l END AS jml_L, CASE WHEN jml_P IS NULL THEN 0 ELSE jml_P END AS jml_P
FROM         dbo.dc_pendidikan_v LEFT OUTER JOIN
                      dbo.jml_P_DR ON dbo.dc_pendidikan_v.id_dc_pendidikan = dbo.jml_P_DR.id_dc_pendidikan LEFT OUTER JOIN
                      dbo.jml_L_DR ON dbo.dc_pendidikan_v.id_dc_pendidikan = dbo.jml_L_DR.id_dc_pendidikan LEFT OUTER JOIN
                      dbo.jml_P_rl_2_v ON dbo.dc_pendidikan_v.id_dc_pendidikan = dbo.jml_P_rl_2_v.id_dc_pendidikan LEFT OUTER JOIN
                      dbo.jml_L_rl_2_v ON dbo.dc_pendidikan_v.id_dc_pendidikan = dbo.jml_L_rl_2_v.id_dc_pendidikan
GROUP BY dbo.dc_pendidikan_v.nama_grup, dbo.dc_pendidikan_v.kd_grup_kualifikasi, CASE WHEN jml_L IS NULL THEN 0 ELSE jml_l END, CASE WHEN jml_P IS NULL THEN 0 ELSE jml_P END, 
                      dbo.dc_pendidikan_v.pendidikan, dbo.dc_pendidikan_v.id_dc_pendidikan
ORDER BY dbo.dc_pendidikan_v.id_dc_pendidikan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rl_2_v]");
    }
};
