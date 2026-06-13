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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_lab_nasabah_sum_v
AS
SELECT     TOP (100) PERCENT CASE WHEN pt IS NULL THEN 0 ELSE pt END AS pt, CASE WHEN umum IS NULL THEN 0 ELSE umum END AS umum, CASE WHEN jamkesda IS NULL 
                      THEN 0 ELSE jamkesda END AS jamkesda, CASE WHEN BpjsPbi IS NULL THEN 0 ELSE BpjsPbi END AS BpjsPbi, CASE WHEN BpjsNonPbi IS NULL THEN 0 ELSE BpjsNonPbi END AS BpjsNonPbi, 
                      CASE WHEN BpjsKtngkrja IS NULL THEN 0 ELSE BpjsKtngkrja END AS BpjsKtngkrja, CASE WHEN asuransi IS NULL THEN 0 ELSE asuransi END AS asuransi, dbo.lap_kunjungan_pm_new_temp.tgl, 
                      dbo.lap_kunjungan_pm_new_temp.bln, dbo.lap_kunjungan_pm_new_temp.thn, dbo.lap_kunjungan_pm_new_temp.kode_bagian
FROM         dbo.lap_kunjungan_pm_BpjsNonPbi_v RIGHT OUTER JOIN
                      dbo.lap_kunjungan_pm_new_temp LEFT OUTER JOIN
                      dbo.lap_kunjungan_pm_asuransi_v ON dbo.lap_kunjungan_pm_new_temp.kode_bagian = dbo.lap_kunjungan_pm_asuransi_v.kode_bagian AND 
                      dbo.lap_kunjungan_pm_new_temp.tgl = dbo.lap_kunjungan_pm_asuransi_v.tgl AND dbo.lap_kunjungan_pm_new_temp.bln = dbo.lap_kunjungan_pm_asuransi_v.bln AND 
                      dbo.lap_kunjungan_pm_new_temp.thn = dbo.lap_kunjungan_pm_asuransi_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_pm_umum_v ON dbo.lap_kunjungan_pm_new_temp.kode_bagian = dbo.lap_kunjungan_pm_umum_v.kode_bagian AND 
                      dbo.lap_kunjungan_pm_new_temp.tgl = dbo.lap_kunjungan_pm_umum_v.tgl AND dbo.lap_kunjungan_pm_new_temp.bln = dbo.lap_kunjungan_pm_umum_v.bln AND 
                      dbo.lap_kunjungan_pm_new_temp.thn = dbo.lap_kunjungan_pm_umum_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_pm_BpjsKtngkrja_v ON dbo.lap_kunjungan_pm_new_temp.kode_bagian = dbo.lap_kunjungan_pm_BpjsKtngkrja_v.kode_bagian AND 
                      dbo.lap_kunjungan_pm_new_temp.tgl = dbo.lap_kunjungan_pm_BpjsKtngkrja_v.tgl AND dbo.lap_kunjungan_pm_new_temp.bln = dbo.lap_kunjungan_pm_BpjsKtngkrja_v.bln AND 
                      dbo.lap_kunjungan_pm_new_temp.thn = dbo.lap_kunjungan_pm_BpjsKtngkrja_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_pm_jamkesda_v ON dbo.lap_kunjungan_pm_new_temp.kode_bagian = dbo.lap_kunjungan_pm_jamkesda_v.kode_bagian AND 
                      dbo.lap_kunjungan_pm_new_temp.tgl = dbo.lap_kunjungan_pm_jamkesda_v.tgl AND dbo.lap_kunjungan_pm_new_temp.bln = dbo.lap_kunjungan_pm_jamkesda_v.bln AND 
                      dbo.lap_kunjungan_pm_new_temp.thn = dbo.lap_kunjungan_pm_jamkesda_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_pm_pt_v ON dbo.lap_kunjungan_pm_new_temp.kode_bagian = dbo.lap_kunjungan_pm_pt_v.kode_bagian AND 
                      dbo.lap_kunjungan_pm_new_temp.tgl = dbo.lap_kunjungan_pm_pt_v.tgl AND dbo.lap_kunjungan_pm_new_temp.bln = dbo.lap_kunjungan_pm_pt_v.bln AND 
                      dbo.lap_kunjungan_pm_new_temp.thn = dbo.lap_kunjungan_pm_pt_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_pm_BpjsPbi_v ON dbo.lap_kunjungan_pm_new_temp.kode_bagian = dbo.lap_kunjungan_pm_BpjsPbi_v.kode_bagian AND 
                      dbo.lap_kunjungan_pm_new_temp.tgl = dbo.lap_kunjungan_pm_BpjsPbi_v.tgl AND dbo.lap_kunjungan_pm_new_temp.bln = dbo.lap_kunjungan_pm_BpjsPbi_v.bln AND 
                      dbo.lap_kunjungan_pm_new_temp.thn = dbo.lap_kunjungan_pm_BpjsPbi_v.thn ON dbo.lap_kunjungan_pm_BpjsNonPbi_v.kode_bagian = dbo.lap_kunjungan_pm_new_temp.kode_bagian AND 
                      dbo.lap_kunjungan_pm_BpjsNonPbi_v.tgl = dbo.lap_kunjungan_pm_new_temp.tgl AND dbo.lap_kunjungan_pm_BpjsNonPbi_v.bln = dbo.lap_kunjungan_pm_new_temp.bln AND 
                      dbo.lap_kunjungan_pm_BpjsNonPbi_v.thn = dbo.lap_kunjungan_pm_new_temp.thn
GROUP BY dbo.lap_kunjungan_pm_new_temp.tgl, dbo.lap_kunjungan_pm_new_temp.bln, dbo.lap_kunjungan_pm_new_temp.thn, CASE WHEN pt IS NULL THEN 0 ELSE pt END, CASE WHEN umum IS NULL 
                      THEN 0 ELSE umum END, CASE WHEN jamkesda IS NULL THEN 0 ELSE jamkesda END, CASE WHEN BpjsPbi IS NULL THEN 0 ELSE BpjsPbi END, CASE WHEN BpjsNonPbi IS NULL 
                      THEN 0 ELSE BpjsNonPbi END, CASE WHEN BpjsKtngkrja IS NULL THEN 0 ELSE BpjsKtngkrja END, CASE WHEN asuransi IS NULL THEN 0 ELSE asuransi END, 
                      dbo.lap_kunjungan_pm_new_temp.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_lab_nasabah_sum_v]");
    }
};
