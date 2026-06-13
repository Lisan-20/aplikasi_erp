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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_nasabah_all_v
AS
SELECT     dbo.lap_kunjungan_LP_v.tgl, dbo.lap_kunjungan_LP_v.bln, dbo.lap_kunjungan_LP_v.thn, CASE WHEN lap_kunjungan_BpjsPbi_v.BpjsPbi IS NULL 
                      THEN 0 ELSE lap_kunjungan_BpjsPbi_v.BpjsPbi END AS BpjsPbi, CASE WHEN lap_kunjungan_BpjsKtngkrja_v.BpjsKtngkrja IS NULL 
                      THEN 0 ELSE lap_kunjungan_BpjsKtngkrja_v.BpjsKtngkrja END AS BpjsKtngkrja, CASE WHEN lap_kunjungan_jamkesda_v.jamkesda IS NULL 
                      THEN 0 ELSE lap_kunjungan_jamkesda_v.jamkesda END AS jamkesda, CASE WHEN lap_kunjungan_BpjsNonPbi_v.BpjsNonPbi IS NULL 
                      THEN 0 ELSE lap_kunjungan_BpjsNonPbi_v.BpjsNonPbi END AS BpjsNonPbi, CASE WHEN lap_kunjungan_pt_v.pt IS NULL THEN 0 ELSE lap_kunjungan_pt_v.pt END AS pt, 
                      CASE WHEN lap_kunjungan_asuransi_v.asuransi IS NULL THEN 0 ELSE lap_kunjungan_asuransi_v.asuransi END AS asuransi, CASE WHEN lap_kunjungan_umum_v.umum IS NULL 
                      THEN 0 ELSE lap_kunjungan_umum_v.umum END AS umum, dbo.lap_kunjungan_new_temp.umum AS umum1, dbo.lap_kunjungan_new_temp.BpjsPbi AS BpjsPbi1, 
                      dbo.lap_kunjungan_new_temp.BpjsNonPbi AS BpjsNonPbi1, dbo.lap_kunjungan_new_temp.BpjsKtngkrja AS BpjsKtngkrja1, dbo.lap_kunjungan_new_temp.jamkesda AS jamkesda1, 
                      dbo.lap_kunjungan_new_temp.pt AS pt1, dbo.lap_kunjungan_new_temp.asuransi AS asuransi1, dbo.lap_kunjungan_LP_v.validasi_lap_rm, dbo.lap_kunjungan_new_temp.bagian
FROM         dbo.lap_kunjungan_new_temp RIGHT OUTER JOIN
                      dbo.lap_kunjungan_LP_v ON dbo.lap_kunjungan_new_temp.tglnya = dbo.lap_kunjungan_LP_v.tgl AND dbo.lap_kunjungan_new_temp.blnnya = dbo.lap_kunjungan_LP_v.bln AND 
                      dbo.lap_kunjungan_new_temp.thnnya = dbo.lap_kunjungan_LP_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_umum_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_umum_v.tgl AND dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_umum_v.bln AND 
                      dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_umum_v.thn AND dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_umum_v.validasi_lap_rm LEFT OUTER JOIN
                      dbo.lap_kunjungan_asuransi_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_asuransi_v.tgl AND dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_asuransi_v.bln AND 
                      dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_asuransi_v.thn AND dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_asuransi_v.validasi_lap_rm LEFT OUTER JOIN
                      dbo.lap_kunjungan_pt_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_pt_v.tgl AND dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_pt_v.bln AND 
                      dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_pt_v.thn AND dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_pt_v.validasi_lap_rm LEFT OUTER JOIN
                      dbo.lap_kunjungan_jamkesda_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_jamkesda_v.tgl AND dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_jamkesda_v.bln AND 
                      dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_jamkesda_v.thn AND dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_jamkesda_v.validasi_lap_rm LEFT OUTER JOIN
                      dbo.lap_kunjungan_BpjsNonPbi_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_BpjsNonPbi_v.tgl AND dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_BpjsNonPbi_v.bln AND 
                      dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_BpjsNonPbi_v.thn AND dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_BpjsNonPbi_v.validasi_lap_rm LEFT OUTER JOIN
                      dbo.lap_kunjungan_BpjsKtngkrja_v ON dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_BpjsKtngkrja_v.tgl AND dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_BpjsKtngkrja_v.bln AND 
                      dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_BpjsKtngkrja_v.thn AND dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_BpjsKtngkrja_v.validasi_lap_rm LEFT OUTER JOIN
                      dbo.lap_kunjungan_BpjsPbi_v ON dbo.lap_kunjungan_LP_v.validasi_lap_rm = dbo.lap_kunjungan_BpjsPbi_v.validasi_lap_rm AND 
                      dbo.lap_kunjungan_LP_v.tgl = dbo.lap_kunjungan_BpjsPbi_v.tgl AND dbo.lap_kunjungan_LP_v.bln = dbo.lap_kunjungan_BpjsPbi_v.bln AND 
                      dbo.lap_kunjungan_LP_v.thn = dbo.lap_kunjungan_BpjsPbi_v.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_nasabah_all_v]");
    }
};
