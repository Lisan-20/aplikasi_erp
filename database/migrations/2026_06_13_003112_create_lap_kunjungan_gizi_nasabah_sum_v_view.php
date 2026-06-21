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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_gizi_nasabah_sum_v
AS
SELECT     dbo.tc_gizi_view.tgl, dbo.tc_gizi_view.bln, dbo.tc_gizi_view.thn, CASE WHEN pt IS NULL THEN 0 ELSE pt END AS pt, CASE WHEN umum IS NULL THEN 0 ELSE umum END AS umum, 
                      CASE WHEN jamkesda IS NULL THEN 0 ELSE jamkesda END AS jamkesda, CASE WHEN BpjsPbi IS NULL THEN 0 ELSE BpjsPbi END AS BpjsPbi, CASE WHEN BpjsNonPbi IS NULL 
                      THEN 0 ELSE BpjsNonPbi END AS BpjsNonPbi, CASE WHEN BpjsKtngkrja IS NULL THEN 0 ELSE BpjsKtngkrja END AS BpjsKtngkrja, CASE WHEN asuransi IS NULL 
                      THEN 0 ELSE asuransi END AS asuransi, CASE WHEN bpjscob IS NULL THEN 0 ELSE asuransi END AS bpjscob, dbo.tc_gizi_view.distribusi
FROM         dbo.lap_kunjungan_gizi_umum_sum_v RIGHT OUTER JOIN
                      dbo.lap_kunjungan_gizi_perusahan_sum_v RIGHT OUTER JOIN
                      dbo.tc_gizi_view LEFT OUTER JOIN
                      dbo.lap_kunjungan_gizi_ansuransi_sum_v ON dbo.tc_gizi_view.distribusi = dbo.lap_kunjungan_gizi_ansuransi_sum_v.distribusi AND 
                      dbo.tc_gizi_view.tgl = dbo.lap_kunjungan_gizi_ansuransi_sum_v.tgl AND dbo.tc_gizi_view.bln = dbo.lap_kunjungan_gizi_ansuransi_sum_v.bln AND 
                      dbo.tc_gizi_view.thn = dbo.lap_kunjungan_gizi_ansuransi_sum_v.thn ON dbo.lap_kunjungan_gizi_perusahan_sum_v.distribusi = dbo.tc_gizi_view.distribusi AND 
                      dbo.lap_kunjungan_gizi_perusahan_sum_v.tgl = dbo.tc_gizi_view.tgl AND dbo.lap_kunjungan_gizi_perusahan_sum_v.thn = dbo.tc_gizi_view.thn AND 
                      dbo.lap_kunjungan_gizi_perusahan_sum_v.bln = dbo.tc_gizi_view.bln ON dbo.lap_kunjungan_gizi_umum_sum_v.distribusi = dbo.tc_gizi_view.distribusi AND 
                      dbo.lap_kunjungan_gizi_umum_sum_v.tgl = dbo.tc_gizi_view.tgl AND dbo.lap_kunjungan_gizi_umum_sum_v.bln = dbo.tc_gizi_view.bln AND 
                      dbo.lap_kunjungan_gizi_umum_sum_v.thn = dbo.tc_gizi_view.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_gizi_jamkesda_sum_v ON dbo.tc_gizi_view.distribusi = dbo.lap_kunjungan_gizi_jamkesda_sum_v.distribusi AND 
                      dbo.tc_gizi_view.tgl = dbo.lap_kunjungan_gizi_jamkesda_sum_v.tgl AND dbo.tc_gizi_view.bln = dbo.lap_kunjungan_gizi_jamkesda_sum_v.bln AND 
                      dbo.tc_gizi_view.thn = dbo.lap_kunjungan_gizi_jamkesda_sum_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_gizi_bpjspbi_sum_v ON dbo.tc_gizi_view.distribusi = dbo.lap_kunjungan_gizi_bpjspbi_sum_v.distribusi AND 
                      dbo.tc_gizi_view.tgl = dbo.lap_kunjungan_gizi_bpjspbi_sum_v.tgl AND dbo.tc_gizi_view.bln = dbo.lap_kunjungan_gizi_bpjspbi_sum_v.bln AND 
                      dbo.tc_gizi_view.thn = dbo.lap_kunjungan_gizi_bpjspbi_sum_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_gizi_bpjsnonpbi_sum_v ON dbo.tc_gizi_view.distribusi = dbo.lap_kunjungan_gizi_bpjsnonpbi_sum_v.distribusi AND 
                      dbo.tc_gizi_view.tgl = dbo.lap_kunjungan_gizi_bpjsnonpbi_sum_v.tgl AND dbo.tc_gizi_view.bln = dbo.lap_kunjungan_gizi_bpjsnonpbi_sum_v.bln AND 
                      dbo.tc_gizi_view.thn = dbo.lap_kunjungan_gizi_bpjsnonpbi_sum_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_gizi_bpjsktngkrja_sum_v ON dbo.tc_gizi_view.distribusi = dbo.lap_kunjungan_gizi_bpjsktngkrja_sum_v.distribusi AND 
                      dbo.tc_gizi_view.tgl = dbo.lap_kunjungan_gizi_bpjsktngkrja_sum_v.tgl AND dbo.tc_gizi_view.bln = dbo.lap_kunjungan_gizi_bpjsktngkrja_sum_v.bln AND 
                      dbo.tc_gizi_view.thn = dbo.lap_kunjungan_gizi_bpjsktngkrja_sum_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_gizi_bpjscob_sum_v ON dbo.tc_gizi_view.distribusi = dbo.lap_kunjungan_gizi_bpjscob_sum_v.distribusi AND 
                      dbo.tc_gizi_view.tgl = dbo.lap_kunjungan_gizi_bpjscob_sum_v.tgl AND dbo.tc_gizi_view.bln = dbo.lap_kunjungan_gizi_bpjscob_sum_v.bln AND 
                      dbo.tc_gizi_view.thn = dbo.lap_kunjungan_gizi_bpjscob_sum_v.thn
GROUP BY dbo.tc_gizi_view.tgl, dbo.tc_gizi_view.bln, dbo.tc_gizi_view.thn, CASE WHEN pt IS NULL THEN 0 ELSE pt END, CASE WHEN umum IS NULL THEN 0 ELSE umum END, 
                      CASE WHEN jamkesda IS NULL THEN 0 ELSE jamkesda END, CASE WHEN BpjsPbi IS NULL THEN 0 ELSE BpjsPbi END, CASE WHEN BpjsNonPbi IS NULL THEN 0 ELSE BpjsNonPbi END, 
                      CASE WHEN BpjsKtngkrja IS NULL THEN 0 ELSE BpjsKtngkrja END, CASE WHEN asuransi IS NULL THEN 0 ELSE asuransi END, CASE WHEN bpjscob IS NULL THEN 0 ELSE asuransi END, 
                      dbo.tc_gizi_view.distribusi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_gizi_nasabah_sum_v]");
    }
};
