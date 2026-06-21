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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_perina_blpl_all_v
AS
SELECT        dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm, dbo.lap_kunjungan_perina_sum_all_v.tgl, dbo.lap_kunjungan_perina_sum_all_v.bln, 
                         dbo.lap_kunjungan_perina_sum_all_v.thn, CASE WHEN lap_kunjungan_perina_blpl1_v.blpl1 IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_blpl1_v.blpl1 END AS blpl1, CASE WHEN lap_kunjungan_perina_blpl2_v.blpl2 IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_blpl2_v.blpl2 END AS blpl2, CASE WHEN lap_kunjungan_perina_blpl3_v.blpl3 IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_blpl3_v.blpl3 END AS blpl3, dbo.lap_kunjungan_new_perina_temp.blpl1 AS blpl11, 
                         dbo.lap_kunjungan_new_perina_temp.blpl2 AS blpl21, dbo.lap_kunjungan_new_perina_temp.blpl3 AS blpl31
FROM            dbo.lap_kunjungan_perina_sum_all_v INNER JOIN
                         dbo.lap_kunjungan_new_perina_temp ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_new_perina_temp.tglnya AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_new_perina_temp.blnnya AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_new_perina_temp.thnnya LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_blpl3_v ON dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm = dbo.lap_kunjungan_perina_blpl3_v.validasi_lap_rm AND 
                         dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_blpl3_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_blpl3_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_blpl3_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_blpl2_v ON dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm = dbo.lap_kunjungan_perina_blpl2_v.validasi_lap_rm AND 
                         dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_blpl2_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_blpl2_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_blpl2_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_blpl1_v ON dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm = dbo.lap_kunjungan_perina_blpl1_v.validasi_lap_rm AND 
                         dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_blpl1_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_blpl1_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_blpl1_v.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_perina_blpl_all_v]");
    }
};
