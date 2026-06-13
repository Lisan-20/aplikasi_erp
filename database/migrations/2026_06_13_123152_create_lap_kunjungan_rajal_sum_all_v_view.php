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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_rajal_sum_all_v
AS
SELECT     TOP (100) PERCENT dbo.lap_kunjungan_LP_rajal_v.tgl, dbo.lap_kunjungan_LP_rajal_v.bln, dbo.lap_kunjungan_LP_rajal_v.thn, dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm, 
                      CASE WHEN ank_laki IS NULL THEN 0 ELSE ank_laki END AS ank_laki, CASE WHEN ank_prmp IS NULL THEN 0 ELSE ank_prmp END AS ank_prmp, CASE WHEN dws_laki IS NULL 
                      THEN 0 ELSE dws_laki END AS dws_laki, CASE WHEN dws_prmp IS NULL THEN 0 ELSE dws_prmp END AS dws_prmp, CASE WHEN baru IS NULL THEN 0 ELSE baru END AS baru, 
                      CASE WHEN baru_anak IS NULL THEN 0 ELSE baru_anak END AS baru_anak, CASE WHEN lama IS NULL THEN 0 ELSE lama END AS lama, CASE WHEN lama_anak IS NULL 
                      THEN 0 ELSE lama_anak END AS lama_anak
FROM         dbo.lap_kunjungan_LP_rajal_v LEFT OUTER JOIN
                      dbo.lap_kunjungan_paslama_rajal_v ON dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm = dbo.lap_kunjungan_paslama_rajal_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_LP_rajal_v.tgl = dbo.lap_kunjungan_paslama_rajal_v.tgl AND dbo.lap_kunjungan_LP_rajal_v.bln = dbo.lap_kunjungan_paslama_rajal_v.bln AND 
                      dbo.lap_kunjungan_LP_rajal_v.thn = dbo.lap_kunjungan_paslama_rajal_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_pasbaru_rajal_anak_v ON dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm = dbo.lap_kunjungan_pasbaru_rajal_anak_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_LP_rajal_v.tgl = dbo.lap_kunjungan_pasbaru_rajal_anak_v.tgl AND dbo.lap_kunjungan_LP_rajal_v.bln = dbo.lap_kunjungan_pasbaru_rajal_anak_v.bln AND 
                      dbo.lap_kunjungan_LP_rajal_v.thn = dbo.lap_kunjungan_pasbaru_rajal_anak_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_paslama_rajal_anak_v ON dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm = dbo.lap_kunjungan_paslama_rajal_anak_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_LP_rajal_v.tgl = dbo.lap_kunjungan_paslama_rajal_anak_v.tgl AND dbo.lap_kunjungan_LP_rajal_v.bln = dbo.lap_kunjungan_paslama_rajal_anak_v.bln AND 
                      dbo.lap_kunjungan_LP_rajal_v.thn = dbo.lap_kunjungan_paslama_rajal_anak_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_pasbaru_rajal_v ON dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm = dbo.lap_kunjungan_pasbaru_rajal_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_LP_rajal_v.tgl = dbo.lap_kunjungan_pasbaru_rajal_v.tgl AND dbo.lap_kunjungan_LP_rajal_v.bln = dbo.lap_kunjungan_pasbaru_rajal_v.bln AND 
                      dbo.lap_kunjungan_LP_rajal_v.thn = dbo.lap_kunjungan_pasbaru_rajal_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_ank_laki_rajal_v ON dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm = dbo.lap_kunjungan_ank_laki_rajal_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_LP_rajal_v.tgl = dbo.lap_kunjungan_ank_laki_rajal_v.tgl AND dbo.lap_kunjungan_LP_rajal_v.bln = dbo.lap_kunjungan_ank_laki_rajal_v.bln AND 
                      dbo.lap_kunjungan_LP_rajal_v.thn = dbo.lap_kunjungan_ank_laki_rajal_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_ank_prmp_rajal_v ON dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm = dbo.lap_kunjungan_ank_prmp_rajal_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_LP_rajal_v.tgl = dbo.lap_kunjungan_ank_prmp_rajal_v.tgl AND dbo.lap_kunjungan_LP_rajal_v.bln = dbo.lap_kunjungan_ank_prmp_rajal_v.bln AND 
                      dbo.lap_kunjungan_LP_rajal_v.thn = dbo.lap_kunjungan_ank_prmp_rajal_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_dws_laki_rajal_v ON dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm = dbo.lap_kunjungan_dws_laki_rajal_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_LP_rajal_v.tgl = dbo.lap_kunjungan_dws_laki_rajal_v.tgl AND dbo.lap_kunjungan_LP_rajal_v.bln = dbo.lap_kunjungan_dws_laki_rajal_v.bln AND 
                      dbo.lap_kunjungan_LP_rajal_v.thn = dbo.lap_kunjungan_dws_laki_rajal_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_dws_prmp_rajal_v ON dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm = dbo.lap_kunjungan_dws_prmp_rajal_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_LP_rajal_v.tgl = dbo.lap_kunjungan_dws_prmp_rajal_v.tgl AND dbo.lap_kunjungan_LP_rajal_v.bln = dbo.lap_kunjungan_dws_prmp_rajal_v.bln AND 
                      dbo.lap_kunjungan_LP_rajal_v.thn = dbo.lap_kunjungan_dws_prmp_rajal_v.thn
GROUP BY CASE WHEN ank_laki IS NULL THEN 0 ELSE ank_laki END, CASE WHEN ank_prmp IS NULL THEN 0 ELSE ank_prmp END, CASE WHEN dws_laki IS NULL THEN 0 ELSE dws_laki END, 
                      CASE WHEN dws_prmp IS NULL THEN 0 ELSE dws_prmp END, dbo.lap_kunjungan_LP_rajal_v.bln, dbo.lap_kunjungan_LP_rajal_v.tgl, dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm, 
                      dbo.lap_kunjungan_LP_rajal_v.thn, CASE WHEN baru IS NULL THEN 0 ELSE baru END, CASE WHEN lama IS NULL THEN 0 ELSE lama END, CASE WHEN baru_anak IS NULL 
                      THEN 0 ELSE baru_anak END, CASE WHEN lama_anak IS NULL THEN 0 ELSE lama_anak END
ORDER BY dbo.lap_kunjungan_LP_rajal_v.bln, dbo.lap_kunjungan_LP_rajal_v.tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_rajal_sum_all_v]");
    }
};
