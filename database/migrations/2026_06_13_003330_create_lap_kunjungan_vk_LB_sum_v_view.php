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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_vk_LB_sum_v
AS
SELECT     TOP (100) PERCENT dbo.lap_kunjungan_vk_tgl_v.tgl, dbo.lap_kunjungan_vk_tgl_v.bln, dbo.lap_kunjungan_vk_tgl_v.thn, dbo.lap_kunjungan_vk_tgl_v.kode_bagian, 
                      CASE WHEN baru IS NULL THEN 0 ELSE baru END AS baru, CASE WHEN lama IS NULL THEN 0 ELSE lama END AS lama
FROM         dbo.lap_kunjungan_vk_tgl_v LEFT OUTER JOIN
                      dbo.lap_kunjungan_vk_baru_v ON dbo.lap_kunjungan_vk_tgl_v.tgl = dbo.lap_kunjungan_vk_baru_v.tgl AND 
                      dbo.lap_kunjungan_vk_tgl_v.bln = dbo.lap_kunjungan_vk_baru_v.bln AND dbo.lap_kunjungan_vk_tgl_v.thn = dbo.lap_kunjungan_vk_baru_v.thn AND 
                      dbo.lap_kunjungan_vk_tgl_v.kode_bagian = dbo.lap_kunjungan_vk_baru_v.kode_bagian LEFT OUTER JOIN
                      dbo.lap_kunjungan_vk_lama_v ON dbo.lap_kunjungan_vk_tgl_v.tgl = dbo.lap_kunjungan_vk_lama_v.tgl AND 
                      dbo.lap_kunjungan_vk_tgl_v.bln = dbo.lap_kunjungan_vk_lama_v.bln AND dbo.lap_kunjungan_vk_tgl_v.thn = dbo.lap_kunjungan_vk_lama_v.thn AND 
                      dbo.lap_kunjungan_vk_tgl_v.kode_bagian = dbo.lap_kunjungan_vk_lama_v.kode_bagian
GROUP BY CASE WHEN lama IS NULL THEN 0 ELSE lama END, CASE WHEN baru IS NULL THEN 0 ELSE baru END, dbo.lap_kunjungan_vk_tgl_v.tgl, 
                      dbo.lap_kunjungan_vk_tgl_v.bln, dbo.lap_kunjungan_vk_tgl_v.thn, dbo.lap_kunjungan_vk_tgl_v.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_vk_LB_sum_v]");
    }
};
