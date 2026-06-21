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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_blpl_all_v
AS
SELECT        dbo.lap_kunjungan_new_temp.blplvvip AS blplvvip1, dbo.lap_kunjungan_new_temp.blplvip AS blplvip1, dbo.lap_kunjungan_new_temp.blpl1 AS blpl11, 
                         dbo.lap_kunjungan_new_temp.blpl2a AS blpl2a1, dbo.lap_kunjungan_new_temp.blpl2b, dbo.lap_kunjungan_new_temp.blpl3 AS blpl31, 
                         dbo.lap_kunjungan_new_temp.blpliso, dbo.lap_kunjungan_new_temp.blpl3anak, CASE WHEN lap_kunjungan_blplvvip_v.blplvvip IS NULL 
                         THEN 0 ELSE lap_kunjungan_blplvvip_v.blplvvip END AS blplvvip, CASE WHEN lap_kunjungan_blplvip_v.blplvip IS NULL 
                         THEN 0 ELSE lap_kunjungan_blplvip_v.blplvip END AS blplvip, CASE WHEN lap_kunjungan_blpl1_v.blpl1 IS NULL 
                         THEN 0 ELSE lap_kunjungan_blpl1_v.blpl1 END AS blpl1, CASE WHEN lap_kunjungan_blpl2_v.blpl2 IS NULL 
                         THEN 0 ELSE lap_kunjungan_blpl2_v.blpl2 END AS blpl2, CASE WHEN lap_kunjungan_blpl3_v.blpl3 IS NULL 
                         THEN 0 ELSE lap_kunjungan_blpl3_v.blpl3 END AS blpl3, dbo.lap_kunjungan_LP_v.tgl, dbo.lap_kunjungan_LP_v.bln, dbo.lap_kunjungan_LP_v.thn, 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm
FROM            dbo.lap_kunjungan_blplvip_v RIGHT OUTER JOIN
                         dbo.lap_kunjungan_LP_v LEFT OUTER JOIN
                         dbo.lap_kunjungan_new_temp ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_new_temp.tglnya AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_new_temp.blnnya AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_new_temp.thnnya LEFT OUTER JOIN
                         dbo.lap_kunjungan_blpl1_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_blpl1_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_blpl1_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_blpl1_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_blpl1_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_blplvvip_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_blplvvip_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_blplvvip_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_blplvvip_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_blplvvip_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_blpl2_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_blpl2_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_blpl2_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_blpl2_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_blpl2_v.validasi_lap_rm ON 
                         dbo.lap_kunjungan_blplvip_v.validasi_lap_rm = dbo.lap_kunjungan_LP_v.validasi_lap_rm AND dbo.lap_kunjungan_blplvip_v.tgl = dbo.lap_kunjungan_LP_v.tgl AND 
                         dbo.lap_kunjungan_blplvip_v.bln = dbo.lap_kunjungan_LP_v.bln AND dbo.lap_kunjungan_blplvip_v.thn = dbo.lap_kunjungan_LP_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_blpl3_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_blpl3_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_blpl3_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_blpl3_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_blpl3_v.validasi_lap_rm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_blpl_all_v]");
    }
};
