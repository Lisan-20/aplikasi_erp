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
        DB::statement("CREATE VIEW dbo.lap_penyakit_lama_baru_v
AS
SELECT     TOP (100) PERCENT dbo.lap_penyakit_baru_v.kode_bagian, dbo.lap_penyakit_baru_v.bulan, dbo.lap_penyakit_baru_v.kode_icd, 
                      SUM(CASE WHEN dbo.lap_penyakit_lama_v.lama IS NULL THEN 0 ELSE dbo.lap_penyakit_lama_v.lama END) AS lama, 
                      SUM(CASE WHEN dbo.lap_penyakit_baru_v.baru IS NULL THEN 0 ELSE dbo.lap_penyakit_baru_v.baru END) AS baru, dbo.lap_penyakit_baru_v.kode_kelompok, 
                      dbo.lap_penyakit_baru_v.tahun, CASE WHEN dbo.lap_penyakit_baru_v.kode_perusahaan IS NULL 
                      THEN 0 ELSE dbo.lap_penyakit_baru_v.kode_perusahaan END AS kode_perusahaan
FROM         dbo.lap_penyakit_baru_v FULL OUTER JOIN
                      dbo.lap_penyakit_lama_v ON dbo.lap_penyakit_baru_v.kode_bagian = dbo.lap_penyakit_lama_v.kode_bagian AND 
                      dbo.lap_penyakit_baru_v.kode_kelompok = dbo.lap_penyakit_lama_v.kode_kelompok AND dbo.lap_penyakit_baru_v.bulan = dbo.lap_penyakit_lama_v.bulan AND 
                      dbo.lap_penyakit_baru_v.tahun = dbo.lap_penyakit_lama_v.tahun AND dbo.lap_penyakit_baru_v.kode_perusahaan = dbo.lap_penyakit_lama_v.kode_perusahaan AND
                       dbo.lap_penyakit_baru_v.kode_icd = dbo.lap_penyakit_lama_v.kode_icd
GROUP BY dbo.lap_penyakit_baru_v.kode_bagian, dbo.lap_penyakit_baru_v.bulan, dbo.lap_penyakit_baru_v.kode_icd, dbo.lap_penyakit_baru_v.kode_kelompok, 
                      dbo.lap_penyakit_baru_v.tahun, CASE WHEN dbo.lap_penyakit_baru_v.kode_perusahaan IS NULL 
                      THEN 0 ELSE dbo.lap_penyakit_baru_v.kode_perusahaan END
ORDER BY dbo.lap_penyakit_baru_v.kode_icd
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_penyakit_lama_baru_v]");
    }
};
