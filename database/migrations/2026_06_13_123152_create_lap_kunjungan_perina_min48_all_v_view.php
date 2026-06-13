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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_perina_min48_all_v
AS
SELECT        dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm, dbo.lap_kunjungan_perina_sum_all_v.tgl, dbo.lap_kunjungan_perina_sum_all_v.bln, 
                         dbo.lap_kunjungan_perina_sum_all_v.thn, CASE WHEN lap_kunjungan_perina_min481_v.min481 IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_min481_v.min481 END AS min481, CASE WHEN lap_kunjungan_perina_min482_v.min482 IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_min482_v.min482 END AS min482, CASE WHEN lap_kunjungan_perina_min483_v.min483 IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_min483_v.min483 END AS min483, dbo.lap_kunjungan_new_perina_temp.min483 AS min4831, 
                         dbo.lap_kunjungan_new_perina_temp.min482 AS min4821, dbo.lap_kunjungan_new_perina_temp.min481 AS min4811
FROM            dbo.lap_kunjungan_new_perina_temp INNER JOIN
                         dbo.lap_kunjungan_perina_sum_all_v ON dbo.lap_kunjungan_new_perina_temp.tglnya = dbo.lap_kunjungan_perina_sum_all_v.tgl AND 
                         dbo.lap_kunjungan_new_perina_temp.blnnya = dbo.lap_kunjungan_perina_sum_all_v.bln AND 
                         dbo.lap_kunjungan_new_perina_temp.thnnya = dbo.lap_kunjungan_perina_sum_all_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_min481_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_min481_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_min481_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_min481_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_min482_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_min482_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_min482_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_min482_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_min483_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_min483_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_min483_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_min483_v.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_perina_min48_all_v]");
    }
};
