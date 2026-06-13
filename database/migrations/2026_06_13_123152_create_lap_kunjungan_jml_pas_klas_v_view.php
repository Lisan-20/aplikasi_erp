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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_jml_pas_klas_v
AS
SELECT        TOP (100) PERCENT dbo.lap_kunjungan_LP_v.validasi_lap_rm, dbo.lap_kunjungan_LP_v.tgl, dbo.lap_kunjungan_LP_v.bln, dbo.lap_kunjungan_LP_v.thn, 
                         CASE WHEN lap_kunjungan_pas1_v.pas1 IS NULL THEN 0 ELSE lap_kunjungan_pas1_v.pas1 END AS pas1, CASE WHEN lap_kunjungan_pas3_v.pas3 IS NULL 
                         THEN 0 ELSE lap_kunjungan_pas3_v.pas3 END AS pas3, CASE WHEN lap_kunjungan_pas2a_v.pas2a IS NULL 
                         THEN 0 ELSE lap_kunjungan_pas2a_v.pas2a END AS pas2a, CASE WHEN lap_kunjungan_pasvip_v.pasvip IS NULL 
                         THEN 0 ELSE lap_kunjungan_pasvip_v.pasvip END AS pasvip, CASE WHEN lap_kunjungan_pasvvip_v.pasvvip IS NULL 
                         THEN 0 ELSE lap_kunjungan_pasvvip_v.pasvvip END AS pasvvip, dbo.lap_kunjungan_new_temp.pasvvip AS pasvvip1, 
                         dbo.lap_kunjungan_new_temp.pasvip AS pasvip1, dbo.lap_kunjungan_new_temp.pas1 AS pas11, dbo.lap_kunjungan_new_temp.pas2a AS pas2a1, 
                         dbo.lap_kunjungan_new_temp.pas3 AS pas31
FROM            dbo.lap_kunjungan_new_temp RIGHT OUTER JOIN
                         dbo.lap_kunjungan_LP_v ON dbo.lap_kunjungan_new_temp.tglnya = dbo.lap_kunjungan_LP_v.tgl AND 
                         dbo.lap_kunjungan_new_temp.blnnya = dbo.lap_kunjungan_LP_v.bln AND dbo.lap_kunjungan_new_temp.thnnya = dbo.lap_kunjungan_LP_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_pas2a_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_pas2a_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_pas2a_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_pas2a_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_pas2a_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_pasvvip_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_pasvvip_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_pasvvip_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_pasvvip_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_pasvvip_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_pasvip_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_pasvip_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_pasvip_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_pasvip_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_pasvip_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_pas3_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_pas3_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_pas3_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_pas3_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_pas3_v.validasi_lap_rm LEFT OUTER JOIN
                         dbo.lap_kunjungan_pas1_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_pas1_v.tgl AND 
                         dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_pas1_v.bln AND dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_pas1_v.thn AND 
                         dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_pas1_v.validasi_lap_rm
ORDER BY dbo.lap_kunjungan_LP_v.bln, dbo.lap_kunjungan_LP_v.tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_jml_pas_klas_v]");
    }
};
