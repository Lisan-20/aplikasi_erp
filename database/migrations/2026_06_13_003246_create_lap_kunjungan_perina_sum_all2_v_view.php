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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_perina_sum_all2_v
AS
SELECT        dbo.lap_kunjungan_perina_sum_all_v.tgl, dbo.lap_kunjungan_perina_sum_all_v.bln, dbo.lap_kunjungan_perina_sum_all_v.thn, 
                         dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm, CASE WHEN lama IS NULL THEN 0 ELSE lama END AS lama, CASE WHEN baru IS NULL 
                         THEN 0 ELSE baru END AS baru, CASE WHEN by_skt IS NULL THEN 0 ELSE by_skt END AS by_skt, CASE WHEN by_sht IS NULL 
                         THEN 0 ELSE by_sht END AS by_sht
FROM            dbo.lap_kunjungan_perina_sum_all_v LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_by_sht_v ON dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm = dbo.lap_kunjungan_perina_by_sht_v.validasi_lap_rm AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_by_sht_v.thn AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_by_sht_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_by_sht_v.tgl LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_by_skt_v ON dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm = dbo.lap_kunjungan_perina_by_skt_v.validasi_lap_rm AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_by_skt_v.thn AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_by_skt_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_by_skt_v.tgl LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_baru_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_baru_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_baru_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_baru_v.thn AND 
                         dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm = dbo.lap_kunjungan_perina_baru_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_lama_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_lama_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_lama_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_lama_v.thn AND 
                         dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm = dbo.lap_kunjungan_perina_lama_v.validasi_lap_rm
GROUP BY dbo.lap_kunjungan_perina_sum_all_v.tgl, dbo.lap_kunjungan_perina_sum_all_v.bln, dbo.lap_kunjungan_perina_sum_all_v.thn, 
                         dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm, CASE WHEN lama IS NULL THEN 0 ELSE lama END, CASE WHEN baru IS NULL THEN 0 ELSE baru END, 
                         CASE WHEN by_skt IS NULL THEN 0 ELSE by_skt END, CASE WHEN by_sht IS NULL THEN 0 ELSE by_sht END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_perina_sum_all2_v]");
    }
};
