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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_perina_nasabah_all_v
AS
SELECT        dbo.lap_kunjungan_perina_sum_all_v.validasi_lap_rm, dbo.lap_kunjungan_perina_sum_all_v.tgl, dbo.lap_kunjungan_perina_sum_all_v.bln, 
                         dbo.lap_kunjungan_perina_sum_all_v.thn, CASE WHEN lap_kunjungan_perina_BpjsKtngkrja_v.BpjsKtngkrja IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_BpjsKtngkrja_v.BpjsKtngkrja END AS BpjsKtngkrja, CASE WHEN lap_kunjungan_perina_asuransi_v.asuransi IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_asuransi_v.asuransi END AS asuransi, CASE WHEN lap_kunjungan_perina_pt_v.pt IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_pt_v.pt END AS pt, CASE WHEN lap_kunjungan_perina_BpjsPbi_v.BpjsPbi IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_BpjsPbi_v.BpjsPbi END AS BpjsPbi, CASE WHEN lap_kunjungan_perina_umum_v.umum IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_umum_v.umum END AS umum, CASE WHEN lap_kunjungan_perina_NonBpjsPbi_v.NonBpjsPbi IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_NonBpjsPbi_v.NonBpjsPbi END AS BpjsNonPbi, CASE WHEN lap_kunjungan_perina_jamkesda_v.jamkesda IS NULL 
                         THEN 0 ELSE lap_kunjungan_perina_jamkesda_v.jamkesda END AS jamkesda, dbo.lap_kunjungan_new_perina_temp.asuransi AS asuransi1, 
                         dbo.lap_kunjungan_new_perina_temp.pt AS pt1, dbo.lap_kunjungan_new_perina_temp.jamkesda AS jamkesda1, 
                         dbo.lap_kunjungan_new_perina_temp.BpjsKtngkrja AS BpjsKtngkrja1, dbo.lap_kunjungan_new_perina_temp.BpjsNonPbi AS BpjsNonPbi1, 
                         dbo.lap_kunjungan_new_perina_temp.BpjsPbi AS BpjsPbi1, dbo.lap_kunjungan_new_perina_temp.umum AS umum1
FROM            dbo.lap_kunjungan_perina_sum_all_v INNER JOIN
                         dbo.lap_kunjungan_new_perina_temp ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_new_perina_temp.tglnya AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_new_perina_temp.blnnya AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_new_perina_temp.thnnya LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_jamkesda_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_jamkesda_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_jamkesda_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_jamkesda_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_NonBpjsPbi_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_NonBpjsPbi_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_NonBpjsPbi_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_NonBpjsPbi_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_umum_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_umum_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_umum_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_umum_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_BpjsPbi_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_BpjsPbi_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_BpjsPbi_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_BpjsPbi_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_pt_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_pt_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_pt_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_pt_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_asuransi_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_asuransi_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_asuransi_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_asuransi_v.thn LEFT OUTER JOIN
                         dbo.lap_kunjungan_perina_BpjsKtngkrja_v ON dbo.lap_kunjungan_perina_sum_all_v.tgl = dbo.lap_kunjungan_perina_BpjsKtngkrja_v.tgl AND 
                         dbo.lap_kunjungan_perina_sum_all_v.bln = dbo.lap_kunjungan_perina_BpjsKtngkrja_v.bln AND 
                         dbo.lap_kunjungan_perina_sum_all_v.thn = dbo.lap_kunjungan_perina_BpjsKtngkrja_v.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_perina_nasabah_all_v]");
    }
};
