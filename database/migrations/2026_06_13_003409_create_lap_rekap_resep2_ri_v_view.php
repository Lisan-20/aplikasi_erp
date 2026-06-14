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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rekap_resep2_ri_v
AS
SELECT     TOP (100) PERCENT dbo.lap_kunjungan_far_temp.tglnya, dbo.lap_kunjungan_far_temp.blnnya, dbo.lap_kunjungan_far_temp.thnnya, CASE WHEN BpjsPbi IS NULL 
                      THEN 0 ELSE BpjsPbi END AS BpjsPbi, dbo.lap_kunjungan_far_temp.ipd_BpjsPbi, CASE WHEN BpjsNonPbi IS NULL THEN 0 ELSE BpjsNonPbi END AS BpjsNonPbi, 
                      dbo.lap_kunjungan_far_temp.ipd_BpjsNonPbi, CASE WHEN asuransi IS NULL THEN 0 ELSE asuransi END AS asuransi, dbo.lap_kunjungan_far_temp.ipd_asuransi, CASE WHEN pt IS NULL 
                      THEN 0 ELSE pt END AS pt, dbo.lap_kunjungan_far_temp.ipd_pt
FROM         dbo.lap_kunjungan_far_temp LEFT OUTER JOIN
                      dbo.lap_rekap_resep_pt_ri_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_pt_ri_v.tgl AND dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_pt_ri_v.bln AND 
                      dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_pt_ri_v.thn LEFT OUTER JOIN
                      dbo.lap_rekap_resep_asuransi_ri_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_asuransi_ri_v.tgl AND 
                      dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_asuransi_ri_v.bln AND dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_asuransi_ri_v.thn LEFT OUTER JOIN
                      dbo.lap_rekap_resep_BpjsPbi_ri_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_BpjsPbi_ri_v.tgl AND 
                      dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_BpjsPbi_ri_v.bln AND dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_BpjsPbi_ri_v.thn LEFT OUTER JOIN
                      dbo.lap_rekap_resep_nonPBI_ri_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_nonPBI_ri_v.tgl AND 
                      dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_nonPBI_ri_v.bln AND dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_nonPBI_ri_v.thn
ORDER BY dbo.lap_kunjungan_far_temp.tglnya
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rekap_resep2_ri_v]");
    }
};
