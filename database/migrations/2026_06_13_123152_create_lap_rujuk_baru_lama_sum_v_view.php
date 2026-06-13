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
        DB::statement("CREATE VIEW dbo.lap_rujuk_baru_lama_sum_v
AS
SELECT     dbo.lap_rujuk_baru_v.bln, dbo.lap_rujuk_lama_v.thn, dbo.lap_rujuk_baru_v.id_dc_asal_pasien, dbo.lap_rujuk_lama_v.kode_bagian, 
                      dbo.lap_rujuk_baru_v.kode_kelompok, dbo.lap_rujuk_lama_v.kode_perusahaan, SUM(dbo.lap_rujuk_baru_v.baru) AS baru, SUM(dbo.lap_rujuk_lama_v.lama) 
                      AS lama
FROM         dbo.lap_rujuk_baru_v INNER JOIN
                      dbo.lap_rujuk_lama_v ON dbo.lap_rujuk_baru_v.bln = dbo.lap_rujuk_lama_v.bln AND dbo.lap_rujuk_baru_v.thn = dbo.lap_rujuk_lama_v.thn AND 
                      dbo.lap_rujuk_baru_v.id_dc_asal_pasien = dbo.lap_rujuk_lama_v.id_dc_asal_pasien AND 
                      dbo.lap_rujuk_baru_v.kode_bagian = dbo.lap_rujuk_lama_v.kode_bagian AND dbo.lap_rujuk_baru_v.kode_kelompok = dbo.lap_rujuk_lama_v.kode_kelompok AND 
                      dbo.lap_rujuk_baru_v.kode_perusahaan = dbo.lap_rujuk_lama_v.kode_perusahaan
GROUP BY dbo.lap_rujuk_baru_v.bln, dbo.lap_rujuk_lama_v.thn, dbo.lap_rujuk_baru_v.id_dc_asal_pasien, dbo.lap_rujuk_lama_v.kode_bagian, 
                      dbo.lap_rujuk_baru_v.kode_kelompok, dbo.lap_rujuk_lama_v.kode_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rujuk_baru_lama_sum_v]");
    }
};
