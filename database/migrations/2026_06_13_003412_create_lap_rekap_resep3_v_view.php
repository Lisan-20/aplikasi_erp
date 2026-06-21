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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rekap_resep3_v
AS
SELECT     TOP (100) PERCENT dbo.lap_kunjungan_far_temp.tglnya, dbo.lap_kunjungan_far_temp.blnnya, dbo.lap_kunjungan_far_temp.thnnya, CASE WHEN BpjsKtngkrja IS NULL 
                      THEN 0 ELSE BpjsKtngkrja END AS BpjsKtngkrja, dbo.lap_kunjungan_far_temp.opd_BpjsKtngkrja, CASE WHEN BpjsCob IS NULL THEN 0 ELSE BpjsCob END AS BpjsCob, 
                      dbo.lap_kunjungan_far_temp.opd_BpjsCob, CASE WHEN jamkesda IS NULL THEN 0 ELSE jamkesda END AS jamkesda, dbo.lap_kunjungan_far_temp.opd_jamkesda, CASE WHEN umum IS NULL 
                      THEN 0 ELSE umum END AS umum, dbo.lap_kunjungan_far_temp.opd_umum
FROM         dbo.lap_rekap_resep_jamkesda_v RIGHT OUTER JOIN
                      dbo.lap_kunjungan_far_temp INNER JOIN
                      dbo.lap_rekap_resep_umum_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_umum_v.tgl AND dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_umum_v.bln AND 
                      dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_umum_v.thn ON dbo.lap_rekap_resep_jamkesda_v.tgl = dbo.lap_kunjungan_far_temp.tglnya AND 
                      dbo.lap_rekap_resep_jamkesda_v.bln = dbo.lap_kunjungan_far_temp.blnnya AND dbo.lap_rekap_resep_jamkesda_v.thn = dbo.lap_kunjungan_far_temp.thnnya LEFT OUTER JOIN
                      dbo.lap_rekap_resep_BpjsCob_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_BpjsCob_v.tgl AND 
                      dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_BpjsCob_v.bln AND dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_BpjsCob_v.thn LEFT OUTER JOIN
                      dbo.lap_rekap_resep_BpjsKtngkrja_v ON dbo.lap_kunjungan_far_temp.tglnya = dbo.lap_rekap_resep_BpjsKtngkrja_v.tgl AND 
                      dbo.lap_kunjungan_far_temp.blnnya = dbo.lap_rekap_resep_BpjsKtngkrja_v.bln AND dbo.lap_kunjungan_far_temp.thnnya = dbo.lap_rekap_resep_BpjsKtngkrja_v.thn
ORDER BY dbo.lap_kunjungan_far_temp.tglnya
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rekap_resep3_v]");
    }
};
