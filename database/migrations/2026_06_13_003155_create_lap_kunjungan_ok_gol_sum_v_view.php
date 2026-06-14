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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_ok_gol_sum_v
AS
SELECT     CASE WHEN dbo.lap_kunjungan_ok_gol_kcl_v.JmlPas IS NULL THEN 0 ELSE dbo.lap_kunjungan_ok_gol_kcl_v.JmlPas END AS kecil, 
                      CASE WHEN dbo.lap_kunjungan_ok_gol_sdng_v.JmlPas IS NULL THEN 0 ELSE dbo.lap_kunjungan_ok_gol_sdng_v.JmlPas END AS sedang, 
                      CASE WHEN dbo.lap_kunjungan_ok_gol_bsr_v.JmlPas IS NULL THEN 0 ELSE dbo.lap_kunjungan_ok_gol_bsr_v.JmlPas END AS besar, 
                      CASE WHEN dbo.lap_kunjungan_ok_gol_bsrkhs_v.JmlPas IS NULL THEN 0 ELSE dbo.lap_kunjungan_ok_gol_bsrkhs_v.JmlPas END AS besar_khusus, 
                      dbo.lap_kunjungan_ok_tind_sum_v.kode_bagian, dbo.lap_kunjungan_ok_tind_sum_v.tgl, dbo.lap_kunjungan_ok_tind_sum_v.bln, dbo.lap_kunjungan_ok_tind_sum_v.thn
FROM         dbo.lap_kunjungan_ok_tind_sum_v LEFT OUTER JOIN
                      dbo.lap_kunjungan_ok_gol_bsrkhs_v ON dbo.lap_kunjungan_ok_tind_sum_v.tgl = dbo.lap_kunjungan_ok_gol_bsrkhs_v.tgl AND 
                      dbo.lap_kunjungan_ok_tind_sum_v.bln = dbo.lap_kunjungan_ok_gol_bsrkhs_v.bln AND dbo.lap_kunjungan_ok_tind_sum_v.thn = dbo.lap_kunjungan_ok_gol_bsrkhs_v.thn AND 
                      dbo.lap_kunjungan_ok_tind_sum_v.kode_bagian = dbo.lap_kunjungan_ok_gol_bsrkhs_v.kode_bagian LEFT OUTER JOIN
                      dbo.lap_kunjungan_ok_gol_kcl_v ON dbo.lap_kunjungan_ok_tind_sum_v.tgl = dbo.lap_kunjungan_ok_gol_kcl_v.tgl AND 
                      dbo.lap_kunjungan_ok_tind_sum_v.bln = dbo.lap_kunjungan_ok_gol_kcl_v.bln AND dbo.lap_kunjungan_ok_tind_sum_v.thn = dbo.lap_kunjungan_ok_gol_kcl_v.thn AND 
                      dbo.lap_kunjungan_ok_tind_sum_v.kode_bagian = dbo.lap_kunjungan_ok_gol_kcl_v.kode_bagian LEFT OUTER JOIN
                      dbo.lap_kunjungan_ok_gol_bsr_v ON dbo.lap_kunjungan_ok_tind_sum_v.tgl = dbo.lap_kunjungan_ok_gol_bsr_v.tgl AND 
                      dbo.lap_kunjungan_ok_tind_sum_v.bln = dbo.lap_kunjungan_ok_gol_bsr_v.bln AND dbo.lap_kunjungan_ok_tind_sum_v.thn = dbo.lap_kunjungan_ok_gol_bsr_v.thn AND 
                      dbo.lap_kunjungan_ok_tind_sum_v.kode_bagian = dbo.lap_kunjungan_ok_gol_bsr_v.kode_bagian LEFT OUTER JOIN
                      dbo.lap_kunjungan_ok_gol_sdng_v ON dbo.lap_kunjungan_ok_tind_sum_v.tgl = dbo.lap_kunjungan_ok_gol_sdng_v.tgl AND 
                      dbo.lap_kunjungan_ok_tind_sum_v.bln = dbo.lap_kunjungan_ok_gol_sdng_v.bln AND dbo.lap_kunjungan_ok_tind_sum_v.thn = dbo.lap_kunjungan_ok_gol_sdng_v.thn AND 
                      dbo.lap_kunjungan_ok_tind_sum_v.kode_bagian = dbo.lap_kunjungan_ok_gol_sdng_v.kode_bagian
GROUP BY dbo.lap_kunjungan_ok_tind_sum_v.kode_bagian, dbo.lap_kunjungan_ok_tind_sum_v.tgl, dbo.lap_kunjungan_ok_tind_sum_v.bln, dbo.lap_kunjungan_ok_tind_sum_v.thn, 
                      CASE WHEN dbo.lap_kunjungan_ok_gol_bsrkhs_v.JmlPas IS NULL THEN 0 ELSE dbo.lap_kunjungan_ok_gol_bsrkhs_v.JmlPas END, CASE WHEN dbo.lap_kunjungan_ok_gol_bsr_v.JmlPas IS NULL
                       THEN 0 ELSE dbo.lap_kunjungan_ok_gol_bsr_v.JmlPas END, CASE WHEN dbo.lap_kunjungan_ok_gol_sdng_v.JmlPas IS NULL THEN 0 ELSE dbo.lap_kunjungan_ok_gol_sdng_v.JmlPas END, 
                      CASE WHEN dbo.lap_kunjungan_ok_gol_kcl_v.JmlPas IS NULL THEN 0 ELSE dbo.lap_kunjungan_ok_gol_kcl_v.JmlPas END
HAVING      (dbo.lap_kunjungan_ok_tind_sum_v.kode_bagian = '030901')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_ok_gol_sum_v]");
    }
};
