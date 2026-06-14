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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_min48_all_v
AS
SELECT        dbo.lap_kunjungan_LP_v.tgl, dbo.lap_kunjungan_LP_v.bln, dbo.lap_kunjungan_LP_v.thn, dbo.lap_kunjungan_LP_v.validasi_lap_rm, 
                         CASE WHEN lap_kunjungan_min481_v.min481 IS NULL THEN 0 ELSE lap_kunjungan_min481_v.min481 END AS min481, 
                         CASE WHEN lap_kunjungan_min482a_v.min482a IS NULL THEN 0 ELSE lap_kunjungan_min482a_v.min482a END AS min482a, 
                         CASE WHEN lap_kunjungan_min483_v.min483 IS NULL THEN 0 ELSE lap_kunjungan_min483_v.min483 END AS min483, 
                         CASE WHEN lap_kunjungan_min48vip_v.min48vip IS NULL THEN 0 ELSE lap_kunjungan_min48vip_v.min48vip END AS min48vip, 
                         CASE WHEN lap_kunjungan_min48vvip_v.min48vvip IS NULL THEN 0 ELSE lap_kunjungan_min48vvip_v.min48vvip END AS min48vvip, 
                         dbo.lap_kunjungan_new_temp.min48vvip AS min48vvip1, dbo.lap_kunjungan_new_temp.min48vip AS min48vip1, dbo.lap_kunjungan_new_temp.min481 AS min4811,
                          dbo.lap_kunjungan_new_temp.min482a AS min482a1, dbo.lap_kunjungan_new_temp.min482b, dbo.lap_kunjungan_new_temp.min483 AS min4831, 
                         dbo.lap_kunjungan_new_temp.min48iso, dbo.lap_kunjungan_new_temp.min483anak
FROM            dbo.lap_kunjungan_new_temp INNER JOIN
                         dbo.lap_kunjungan_LP_v ON dbo.lap_kunjungan_new_temp.tglnya = dbo.lap_kunjungan_LP_v.tgl AND 
                         dbo.lap_kunjungan_new_temp.blnnya = dbo.lap_kunjungan_LP_v.bln AND dbo.lap_kunjungan_new_temp.thnnya = dbo.lap_kunjungan_LP_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_min483_v ON dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_min483_v.validasi_lap_rm AND 
                         dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_min483_v.thn AND dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_min483_v.bln AND 
                         dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_min483_v.tgl LEFT OUTER JOIN
                         dbo.lap_kunjungan_min481_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_min481_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_min481_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_min481_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_min481_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_min48vip_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_min48vip_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_min48vip_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_min48vip_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_min48vip_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_min482a_v ON dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_min482a_v.validasi_lap_rm AND 
                         dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_min482a_v.thn AND dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_min482a_v.bln AND 
                         dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_min482a_v.tgl LEFT OUTER JOIN
                         dbo.lap_kunjungan_min48vvip_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_min48vvip_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_min48vvip_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_min48vvip_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_min48vvip_v.validasi_lap_rm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_min48_all_v]");
    }
};
