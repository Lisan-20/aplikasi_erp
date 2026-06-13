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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rekap_resep2_v
AS
SELECT     TOP (100) PERCENT dbo.lap_kunjungan_far_temp.tglnya, dbo.lap_kunjungan_far_temp.blnnya, dbo.lap_kunjungan_far_temp.thnnya, CASE WHEN BpjsPbi IS NULL 
                      THEN 0 ELSE BpjsPbi END AS BpjsPbi, dbo.lap_kunjungan_far_temp.opd_BpjsPbi, CASE WHEN BpjsNonPbi IS NULL THEN 0 ELSE BpjsNonPbi END AS BpjsNonPbi, 
                      dbo.lap_kunjungan_far_temp.opd_BpjsNonPbi, CASE WHEN asuransi IS NULL THEN 0 ELSE asuransi END AS asuransi, dbo.lap_kunjungan_far_temp.opd_asuransi, CASE WHEN pt IS NULL 
                      THEN 0 ELSE pt END AS pt, dbo.lap_kunjungan_far_temp.opd_pt
FROM         dbo.lap_kunjungan_far_temp LEFT OUTER JOIN
                      dbo.lap_rekap_resep_pt_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_pt_v.tgl AND dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_pt_v.bln AND 
                      dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_pt_v.thn LEFT OUTER JOIN
                      dbo.lap_rekap_resep_asuransi_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_asuransi_v.tgl AND 
                      dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_asuransi_v.bln AND dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_asuransi_v.thn LEFT OUTER JOIN
                      dbo.lap_rekap_resep_BpjsPbi_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_BpjsPbi_v.tgl AND dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_BpjsPbi_v.bln AND 
                      dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_BpjsPbi_v.thn LEFT OUTER JOIN
                      dbo.lap_rekap_resep_nonPBI_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_nonPBI_v.tgl AND dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_nonPBI_v.bln AND 
                      dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_nonPBI_v.thn
ORDER BY dbo.lap_kunjungan_far_temp.tglnya
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rekap_resep2_v]");
    }
};
