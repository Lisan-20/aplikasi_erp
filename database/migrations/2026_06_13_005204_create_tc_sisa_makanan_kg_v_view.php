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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_sisa_makanan_kg_v
AS
SELECT     YEAR(tgl_hari_ini) AS thn, MONTH(tgl_hari_ini) AS bln, SUM(pagi_jml_sisa) AS pagi_jml_sisa, SUM(siang_jml_sisa) AS siang_jml_sisa, SUM(sore_jml_sisa) AS sore_jml_sisa, 
                      SUM(pagi_jml_pasien) AS pagi_jml_pasien, SUM(siang_jml_pasien) AS siang_jml_pasien, SUM(sore_jml_pasien) AS sore_jml_pasien
FROM         dbo.tc_sisa_makanan_kg
GROUP BY YEAR(tgl_hari_ini), MONTH(tgl_hari_ini)
HAVING      (YEAR(tgl_hari_ini) >= 2025)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_sisa_makanan_kg_v]");
    }
};
