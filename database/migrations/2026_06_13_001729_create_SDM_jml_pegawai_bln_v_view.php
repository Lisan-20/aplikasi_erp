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
        DB::statement("CREATE OR ALTER VIEW dbo.SDM_jml_pegawai_bln_v
AS
SELECT     TOP (100) PERCENT COUNT(npp) AS jml, tahun AS thn, bulan AS bln
FROM         dbo.tc_gaji_tiap_bulan
GROUP BY tahun, bulan
ORDER BY thn, bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [SDM_jml_pegawai_bln_v]");
    }
};
