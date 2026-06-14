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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_aps_all_v
AS
SELECT        CASE WHEN lap_kunjungan_apsvvip_v.apsvvip IS NULL THEN 0 ELSE lap_kunjungan_apsvvip_v.apsvvip END AS apsvvip, 
                         CASE WHEN lap_kunjungan_apsvip_v.apsvip IS NULL THEN 0 ELSE lap_kunjungan_apsvip_v.apsvip END AS apsvip, 
                         CASE WHEN lap_kunjungan_aps1_v.aps1 IS NULL THEN 0 ELSE lap_kunjungan_aps1_v.aps1 END AS aps1, CASE WHEN lap_kunjungan_aps2_v.aps2 IS NULL 
                         THEN 0 ELSE lap_kunjungan_aps2_v.aps2 END AS aps2, CASE WHEN lap_kunjungan_aps3_v.aps3 IS NULL 
                         THEN 0 ELSE lap_kunjungan_aps3_v.aps3 END AS aps3, dbo.lap_kunjungan_new_temp.apsvvip AS apsvvip1, dbo.lap_kunjungan_new_temp.apsvip AS apsvip1, 
                         dbo.lap_kunjungan_new_temp.aps1 AS aps11, dbo.lap_kunjungan_new_temp.aps2a, dbo.lap_kunjungan_new_temp.aps2b, 
                         dbo.lap_kunjungan_new_temp.aps3 AS aps31, dbo.lap_kunjungan_new_temp.apsiso, dbo.lap_kunjungan_new_temp.aps3anak, dbo.lap_kunjungan_LP_v.tgl, 
                         dbo.lap_kunjungan_LP_v.bln, dbo.lap_kunjungan_LP_v.thn, dbo.lap_kunjungan_LP_v.validasi_lap_rm
FROM            dbo.lap_kunjungan_LP_v LEFT OUTER JOIN
                         dbo.lap_kunjungan_new_temp ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_new_temp.tglnya AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_new_temp.blnnya AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_new_temp.thnnya LEFT OUTER JOIN
                         dbo.lap_kunjungan_aps3_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_aps3_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_aps3_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_aps3_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_aps3_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_aps2_v ON dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_aps2_v.validasi_lap_rm AND 
                         dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_aps2_v.thn AND dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_aps2_v.bln AND 
                         dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_aps2_v.tgl LEFT OUTER JOIN
                         dbo.lap_kunjungan_aps1_v ON dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_aps1_v.validasi_lap_rm AND 
                         dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_aps1_v.tgl AND dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_aps1_v.bln AND 
                         dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_aps1_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_apsvvip_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_apsvvip_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_apsvvip_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_apsvvip_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_apsvvip_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_apsvip_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_apsvip_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_apsvip_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_apsvip_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_apsvip_v.validasi_lap_rm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_aps_all_v]");
    }
};
