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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_sisa_makanan_kg_sum_v
AS
SELECT     TOP (100) PERCENT dbo.tc_sisa_makanan_kg_v.thn, dbo.tc_sisa_makanan_kg_v.bln, dbo.dd_bulan.nama_bulan, 
                      dbo.tc_sisa_makanan_kg_v.pagi_jml_sisa + dbo.tc_sisa_makanan_kg_v.siang_jml_sisa + dbo.tc_sisa_makanan_kg_v.sore_jml_sisa AS Jml_sisa_makanan, 
                      dbo.tc_sisa_makanan_kg_v.pagi_jml_pasien + dbo.tc_sisa_makanan_kg_v.siang_jml_pasien + dbo.tc_sisa_makanan_kg_v.sore_jml_pasien AS jml_pasien
FROM         dbo.tc_sisa_makanan_kg_v INNER JOIN
                      dbo.dd_bulan ON dbo.tc_sisa_makanan_kg_v.bln = dbo.dd_bulan.id_bulan
ORDER BY dbo.tc_sisa_makanan_kg_v.bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_sisa_makanan_kg_sum_v]");
    }
};
