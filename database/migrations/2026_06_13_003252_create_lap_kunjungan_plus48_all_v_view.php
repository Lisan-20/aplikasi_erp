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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_plus48_all_v
AS
SELECT        dbo.lap_kunjungan_LP_v.validasi_lap_rm, dbo.lap_kunjungan_LP_v.tgl, dbo.lap_kunjungan_LP_v.bln, dbo.lap_kunjungan_LP_v.thn, 
                         CASE WHEN lap_kunjungan_plus48vvip_v.plus48vvip IS NULL THEN 0 ELSE lap_kunjungan_plus48vvip_v.plus48vvip END AS plus48vvip, 
                         CASE WHEN lap_kunjungan_plus48vip_v.plus48vip IS NULL THEN 0 ELSE lap_kunjungan_plus48vip_v.plus48vip END AS plus48vip, 
                         CASE WHEN lap_kunjungan_plus481_v.plus481 IS NULL THEN 0 ELSE lap_kunjungan_plus481_v.plus481 END AS plus481, 
                         CASE WHEN lap_kunjungan_plus482_v.plus482 IS NULL THEN 0 ELSE lap_kunjungan_plus482_v.plus482 END AS plus482a, 
                         CASE WHEN lap_kunjungan_plus482_v.plus482 IS NULL THEN 0 ELSE lap_kunjungan_plus482_v.plus482 END AS plus483, 
                         dbo.lap_kunjungan_new_temp.plus48vvip AS plus48vvip1, dbo.lap_kunjungan_new_temp.plus48vip AS plus48vip1, 
                         dbo.lap_kunjungan_new_temp.plus481 AS plus4811, dbo.lap_kunjungan_new_temp.plus482a AS plus482a1, 
                         dbo.lap_kunjungan_new_temp.plus483 AS plus4831
FROM            dbo.lap_kunjungan_LP_v INNER JOIN
                         dbo.lap_kunjungan_new_temp ON dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_new_temp.bagian AND 
                         dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_new_temp.thnnya AND dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_new_temp.blnnya AND 
                         dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_new_temp.tglnya LEFT OUTER JOIN
                         dbo.lap_kunjungan_plus483_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_plus483_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_plus483_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_plus483_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_plus483_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_plus482_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_plus482_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_plus482_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_plus482_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_plus482_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_plus481_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_plus481_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_plus481_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_plus481_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_plus481_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_plus48vip_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_plus48vip_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_plus48vip_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_plus48vip_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_plus48vip_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_plus48vvip_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_plus48vvip_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_plus48vvip_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_plus48vvip_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_plus48vvip_v.validasi_lap_rm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_plus48_all_v]");
    }
};
