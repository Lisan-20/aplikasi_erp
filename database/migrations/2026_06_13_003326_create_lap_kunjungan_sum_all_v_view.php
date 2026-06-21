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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_sum_all_v
AS
SELECT        TOP (100) PERCENT dbo.lap_kunjungan_LP_v.validasi_lap_rm, dbo.lap_kunjungan_LP_v.tgl, dbo.lap_kunjungan_LP_v.bln, dbo.lap_kunjungan_LP_v.thn, 
                         CASE WHEN ank_laki IS NULL THEN 0 ELSE ank_laki END AS ank_laki, CASE WHEN ank_prmp IS NULL THEN 0 ELSE ank_prmp END AS ank_prmp, 
                         CASE WHEN dws_laki IS NULL THEN 0 ELSE dws_laki END AS dws_laki, CASE WHEN dws_prmp IS NULL THEN 0 ELSE dws_prmp END AS dws_prmp, 
                         CASE WHEN baru IS NULL THEN 0 ELSE baru END AS baru, CASE WHEN lama IS NULL THEN 0 ELSE lama END AS lama
FROM            dbo.lap_kunjungan_LP_v LEFT OUTER JOIN
                         dbo.lap_kunjungan_paslama_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_paslama_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_paslama_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_paslama_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_paslama_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_pasbaru_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_pasbaru_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_pasbaru_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_pasbaru_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_pasbaru_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_ank_laki_v ON dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_ank_laki_v.validasi_lap_rm AND 
                         dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_ank_laki_v.tgl AND dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_ank_laki_v.bln AND 
                         dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_ank_laki_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_ank_prmp_v ON dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_ank_prmp_v.validasi_lap_rm AND 
                         dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_ank_prmp_v.tgl AND dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_ank_prmp_v.bln AND 
                         dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_ank_prmp_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_dws_prmp_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_dws_prmp_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_dws_prmp_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_dws_prmp_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_dws_prmp_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_dws_laki_v ON dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_dws_laki_v.validasi_lap_rm AND 
                         dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_dws_laki_v.tgl AND dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_dws_laki_v.bln AND 
                         dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_dws_laki_v.thn
GROUP BY dbo.lap_kunjungan_LP_v.validasi_lap_rm, dbo.lap_kunjungan_LP_v.tgl, dbo.lap_kunjungan_LP_v.bln, dbo.lap_kunjungan_LP_v.thn, CASE WHEN ank_laki IS NULL 
                         THEN 0 ELSE ank_laki END, CASE WHEN ank_prmp IS NULL THEN 0 ELSE ank_prmp END, CASE WHEN dws_laki IS NULL THEN 0 ELSE dws_laki END, 
                         CASE WHEN dws_prmp IS NULL THEN 0 ELSE dws_prmp END, CASE WHEN baru IS NULL THEN 0 ELSE baru END, CASE WHEN lama IS NULL 
                         THEN 0 ELSE lama END
ORDER BY dbo.lap_kunjungan_LP_v.bln, dbo.lap_kunjungan_LP_v.tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_sum_all_v]");
    }
};
