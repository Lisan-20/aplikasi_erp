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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_perina_plus48_all_v
AS
SELECT        dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm, dbo.lap_kunjungan_perina_sum_all_v.tgl, dbo.lap_kunjungan_perina_sum_all_v.bln, 
                         dbo.lap_kunjungan_perina_sum_all_v.thn, CASE WHEN lap_kunjungan_perina_plus481_v.plus481 IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_plus481_v.plus481 END AS plus481, CASE WHEN lap_kunjungan_perina_plus482_v.plus482 IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_plus482_v.plus482 END AS plus482, CASE WHEN lap_kunjungan_perina_plus483_v.plus483 IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_plus483_v.plus483 END AS plus483, dbo.lap_kunjungan_new_perina_temp.plus481 AS plus4811, 
                         dbo.lap_kunjungan_new_perina_temp.plus482 AS plus4821, dbo.lap_kunjungan_new_perina_temp.plus483 AS plus4831
FROM            dbo.lap_kunjungan_new_perina_temp INNER JOIN
                         dbo.lap_kunjungan_perina_sum_all_v ON dbo.lap_kunjungan_new_perina_temp.tglnya = dbo.lap_kunjungan_perina_sum_all_v.tgl AND 
                         dbo.lap_kunjungan_new_perina_temp.blnnya = dbo.lap_kunjungan_perina_sum_all_v.bln AND 
                         dbo.lap_kunjungan_new_perina_temp.thnnya = dbo.lap_kunjungan_perina_sum_all_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_plus483_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_plus483_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_plus483_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_plus483_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_plus482_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_plus482_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_plus482_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_plus482_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_plus481_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_plus481_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_plus481_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_plus481_v.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_perina_plus48_all_v]");
    }
};
