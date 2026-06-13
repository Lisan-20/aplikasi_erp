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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_perina_aps_all_v
AS
SELECT        dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm, dbo.lap_kunjungan_perina_sum_all_v.tgl, dbo.lap_kunjungan_perina_sum_all_v.bln, 
                         dbo.lap_kunjungan_perina_sum_all_v.thn, CASE WHEN lap_kunjungan_perina_aps1_v.aps1 IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_aps1_v.aps1 END AS aps1, CASE WHEN lap_kunjungan_perina_aps2_v.aps2 IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_aps2_v.aps2 END AS aps2, CASE WHEN lap_kunjungan_perina_aps3_v.aps3 IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_aps3_v.aps3 END AS aps3, dbo.lap_kunjungan_new_perina_temp.aps1 AS aps11, 
                         dbo.lap_kunjungan_new_perina_temp.aps2 AS aps21, dbo.lap_kunjungan_new_perina_temp.aps3 AS aps31
FROM            dbo.lap_kunjungan_new_perina_temp INNER JOIN
                         dbo.lap_kunjungan_perina_sum_all_v ON dbo.lap_kunjungan_new_perina_temp.tglnya = dbo.lap_kunjungan_perina_sum_all_v.tgl AND 
                         dbo.lap_kunjungan_new_perina_temp.blnnya = dbo.lap_kunjungan_perina_sum_all_v.bln AND 
                         dbo.lap_kunjungan_new_perina_temp.thnnya = dbo.lap_kunjungan_perina_sum_all_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_aps2_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_aps2_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_aps2_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_aps2_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_aps3_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_aps3_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_aps3_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_aps3_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_aps1_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_aps1_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_aps1_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_aps1_v.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_perina_aps_all_v]");
    }
};
