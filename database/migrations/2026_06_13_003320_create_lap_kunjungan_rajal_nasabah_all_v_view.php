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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_rajal_nasabah_all_v
AS
SELECT     CASE WHEN lap_kunjungan_BpjsPbi_rajal_v.BpjsPbi IS NULL THEN 0 ELSE lap_kunjungan_BpjsPbi_rajal_v.BpjsPbi END AS BpjsPbi, 
                      CASE WHEN lap_kunjungan_jamkesda_rajal_v.jamkesda IS NULL THEN 0 ELSE lap_kunjungan_jamkesda_rajal_v.jamkesda END AS jamkesda, 
                      CASE WHEN lap_kunjungan_BpjsNonPbi_rajal_v.BpjsNonPbi IS NULL THEN 0 ELSE lap_kunjungan_BpjsNonPbi_rajal_v.BpjsNonPbi END AS BpjsNonPbi, 
                      CASE WHEN lap_kunjungan_pt_rajal_v.pt IS NULL THEN 0 ELSE lap_kunjungan_pt_rajal_v.pt END AS pt, CASE WHEN lap_kunjungan_asuransi_rajal_v.asuransi IS NULL 
                      THEN 0 ELSE lap_kunjungan_asuransi_rajal_v.asuransi END AS asuransi, CASE WHEN lap_kunjungan_umum_rajal_v.umum IS NULL 
                      THEN 0 ELSE lap_kunjungan_umum_rajal_v.umum END AS umum, CASE WHEN lap_kunjungan_BpjsKtngkrja_rajal_v.BpjsKtngkrja IS NULL 
                      THEN 0 ELSE lap_kunjungan_BpjsKtngkrja_rajal_v.BpjsKtngkrja END AS BpjsKtngkrja, dbo.lap_kunjungan_LP_rajal_v.tgl, dbo.lap_kunjungan_LP_rajal_v.bln, dbo.lap_kunjungan_LP_rajal_v.thn, 
                      dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm, dbo.lap_rj_new.umum AS umum1, dbo.lap_rj_new.BpjsPbi AS BpjsPbi1, dbo.lap_rj_new.BpjsNonPbi AS BpjsNonPbi1, 
                      dbo.lap_rj_new.BpjsKtngkrja AS BpjsKtngkrja1, dbo.lap_rj_new.jamkesda AS jamkesda1, dbo.lap_rj_new.pt AS pt1, dbo.lap_rj_new.asuransi AS asuransi1
FROM         dbo.lap_kunjungan_BpjsPbi_rajal_v RIGHT OUTER JOIN
                      dbo.lap_kunjungan_LP_rajal_v LEFT OUTER JOIN
                      dbo.lap_kunjungan_BpjsKtngkrja_rajal_v ON dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm = dbo.lap_kunjungan_BpjsKtngkrja_rajal_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_LP_rajal_v.tgl = dbo.lap_kunjungan_BpjsKtngkrja_rajal_v.tgl AND dbo.lap_kunjungan_LP_rajal_v.bln = dbo.lap_kunjungan_BpjsKtngkrja_rajal_v.bln AND 
                      dbo.lap_kunjungan_LP_rajal_v.thn = dbo.lap_kunjungan_BpjsKtngkrja_rajal_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_asuransi_rajal_v ON dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm = dbo.lap_kunjungan_asuransi_rajal_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_LP_rajal_v.tgl = dbo.lap_kunjungan_asuransi_rajal_v.tgl AND dbo.lap_kunjungan_LP_rajal_v.bln = dbo.lap_kunjungan_asuransi_rajal_v.bln AND 
                      dbo.lap_kunjungan_LP_rajal_v.thn = dbo.lap_kunjungan_asuransi_rajal_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_pt_rajal_v ON dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm = dbo.lap_kunjungan_pt_rajal_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_LP_rajal_v.tgl = dbo.lap_kunjungan_pt_rajal_v.tgl AND dbo.lap_kunjungan_LP_rajal_v.bln = dbo.lap_kunjungan_pt_rajal_v.bln AND 
                      dbo.lap_kunjungan_LP_rajal_v.thn = dbo.lap_kunjungan_pt_rajal_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_jamkesda_rajal_v ON dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm = dbo.lap_kunjungan_jamkesda_rajal_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_LP_rajal_v.tgl = dbo.lap_kunjungan_jamkesda_rajal_v.tgl AND dbo.lap_kunjungan_LP_rajal_v.bln = dbo.lap_kunjungan_jamkesda_rajal_v.bln AND 
                      dbo.lap_kunjungan_LP_rajal_v.thn = dbo.lap_kunjungan_jamkesda_rajal_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_umum_rajal_v ON dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm = dbo.lap_kunjungan_umum_rajal_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_LP_rajal_v.tgl = dbo.lap_kunjungan_umum_rajal_v.tgl AND dbo.lap_kunjungan_LP_rajal_v.bln = dbo.lap_kunjungan_umum_rajal_v.bln AND 
                      dbo.lap_kunjungan_LP_rajal_v.thn = dbo.lap_kunjungan_umum_rajal_v.thn ON dbo.lap_kunjungan_BpjsPbi_rajal_v.validasi_lap_rm = dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_BpjsPbi_rajal_v.tgl = dbo.lap_kunjungan_LP_rajal_v.tgl AND dbo.lap_kunjungan_BpjsPbi_rajal_v.bln = dbo.lap_kunjungan_LP_rajal_v.bln AND 
                      dbo.lap_kunjungan_BpjsPbi_rajal_v.thn = dbo.lap_kunjungan_LP_rajal_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_BpjsNonPbi_rajal_v ON dbo.lap_kunjungan_LP_rajal_v.validasi_lap_rm = dbo.lap_kunjungan_BpjsNonPbi_rajal_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_LP_rajal_v.tgl = dbo.lap_kunjungan_BpjsNonPbi_rajal_v.tgl AND dbo.lap_kunjungan_LP_rajal_v.bln = dbo.lap_kunjungan_BpjsNonPbi_rajal_v.bln AND 
                      dbo.lap_kunjungan_LP_rajal_v.thn = dbo.lap_kunjungan_BpjsNonPbi_rajal_v.thn LEFT OUTER JOIN
                      dbo.lap_rj_new ON dbo.lap_kunjungan_LP_rajal_v.tgl = dbo.lap_rj_new.tglnya AND dbo.lap_kunjungan_LP_rajal_v.bln = dbo.lap_rj_new.blnnya AND 
                      dbo.lap_kunjungan_LP_rajal_v.thn = dbo.lap_rj_new.thnnya
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_rajal_nasabah_all_v]");
    }
};
