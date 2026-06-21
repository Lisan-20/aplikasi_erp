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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_igd_BL_v
AS
SELECT     TOP (100) PERCENT dbo.lap_kunjungan_igd_lama_v.jmlPas AS lama, dbo.lap_kunjungan_igd_baru_v.jmlPas AS baru, dbo.lap_kunjungan_igd_baru_v.tgl, dbo.lap_kunjungan_igd_baru_v.bln, 
                      dbo.lap_kunjungan_igd_baru_v.thn
FROM         dbo.lap_kunjungan_igd_baru_v INNER JOIN
                      dbo.lap_kunjungan_igd_lama_v ON dbo.lap_kunjungan_igd_baru_v.tgl = dbo.lap_kunjungan_igd_lama_v.tgl AND dbo.lap_kunjungan_igd_baru_v.bln = dbo.lap_kunjungan_igd_lama_v.bln AND 
                      dbo.lap_kunjungan_igd_baru_v.thn = dbo.lap_kunjungan_igd_lama_v.thn
ORDER BY dbo.lap_kunjungan_igd_baru_v.bln, dbo.lap_kunjungan_igd_lama_v.tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_igd_BL_v]");
    }
};
