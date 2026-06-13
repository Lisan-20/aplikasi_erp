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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_ok_nasabah_v
AS
SELECT     dbo.lap_kunjungan_ok_temp.umum, dbo.lap_kunjungan_ok_temp.BpjsPbi, dbo.lap_kunjungan_ok_temp.BpjsCob, dbo.lap_kunjungan_ok_temp.BpjsNonPbi, 
                      dbo.lap_kunjungan_ok_temp.BpjsKtngkrja, dbo.lap_kunjungan_ok_temp.jamkesda, dbo.lap_kunjungan_ok_temp.pt, dbo.lap_kunjungan_ok_temp.asuransi, dbo.lap_kunjungan_ok_temp.tglnya, 
                      dbo.lap_kunjungan_ok_temp.blnnya, dbo.lap_kunjungan_ok_temp.thnnya, dbo.lap_kunjungan_ok_temp.kode_bagian, CASE WHEN lap_kunjungan_ok_umum_v.jmlPas IS NULL 
                      THEN 0 ELSE lap_kunjungan_ok_umum_v.jmlPas END AS umum1, CASE WHEN lap_kunjungan_ok_ass_v.jmlPas IS NULL THEN 0 ELSE lap_kunjungan_ok_ass_v.jmlPas END AS asuransi1, 
                      CASE WHEN lap_kunjungan_ok_pt_v.jmlPas IS NULL THEN 0 ELSE lap_kunjungan_ok_pt_v.jmlPas END AS pt1, CASE WHEN lap_kunjungan_ok_BpjsKtngkrjn_v.jmlPas IS NULL 
                      THEN 0 ELSE lap_kunjungan_ok_BpjsKtngkrjn_v.jmlPas END AS BpjsKtngkrja1, CASE WHEN lap_kunjungan_ok_BpjsPbi_v.jmlPas IS NULL 
                      THEN 0 ELSE lap_kunjungan_ok_BpjsPbi_v.jmlPas END AS BpjsPbi1, CASE WHEN lap_kunjungan_ok_jamkesda_v.jmlPas IS NULL 
                      THEN 0 ELSE lap_kunjungan_ok_jamkesda_v.jmlPas END AS jamkesda1, CASE WHEN lap_kunjungan_ok_BpjsCob_v.jmlPas IS NULL 
                      THEN 0 ELSE lap_kunjungan_ok_BpjsCob_v.jmlPas END AS BpjsCob1, CASE WHEN lap_kunjungan_ok_BpjsNonPbi_v.jmlPas IS NULL 
                      THEN 0 ELSE lap_kunjungan_ok_BpjsNonPbi_v.jmlPas END AS BpjsNonPbi1
FROM         dbo.lap_kunjungan_ok_temp LEFT OUTER JOIN
                      dbo.lap_kunjungan_ok_BpjsNonPbi_v ON dbo.lap_kunjungan_ok_temp.kode_bagian = dbo.lap_kunjungan_ok_BpjsNonPbi_v.kode_bagian AND 
                      dbo.lap_kunjungan_ok_temp.thnnya = dbo.lap_kunjungan_ok_BpjsNonPbi_v.thn AND dbo.lap_kunjungan_ok_temp.blnnya = dbo.lap_kunjungan_ok_BpjsNonPbi_v.bln AND 
                      dbo.lap_kunjungan_ok_temp.tglnya = dbo.lap_kunjungan_ok_BpjsNonPbi_v.tgl LEFT OUTER JOIN
                      dbo.lap_kunjungan_ok_BpjsCob_v ON dbo.lap_kunjungan_ok_temp.kode_bagian = dbo.lap_kunjungan_ok_BpjsCob_v.kode_bagian AND 
                      dbo.lap_kunjungan_ok_temp.thnnya = dbo.lap_kunjungan_ok_BpjsCob_v.thn AND dbo.lap_kunjungan_ok_temp.blnnya = dbo.lap_kunjungan_ok_BpjsCob_v.bln AND 
                      dbo.lap_kunjungan_ok_temp.tglnya = dbo.lap_kunjungan_ok_BpjsCob_v.tgl LEFT OUTER JOIN
                      dbo.lap_kunjungan_ok_jamkesda_v ON dbo.lap_kunjungan_ok_temp.kode_bagian = dbo.lap_kunjungan_ok_jamkesda_v.kode_bagian AND 
                      dbo.lap_kunjungan_ok_temp.tglnya = dbo.lap_kunjungan_ok_jamkesda_v.tgl AND dbo.lap_kunjungan_ok_temp.blnnya = dbo.lap_kunjungan_ok_jamkesda_v.bln AND 
                      dbo.lap_kunjungan_ok_temp.thnnya = dbo.lap_kunjungan_ok_jamkesda_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_ok_BpjsPbi_v ON dbo.lap_kunjungan_ok_temp.kode_bagian = dbo.lap_kunjungan_ok_BpjsPbi_v.kode_bagian AND 
                      dbo.lap_kunjungan_ok_temp.tglnya = dbo.lap_kunjungan_ok_BpjsPbi_v.tgl AND dbo.lap_kunjungan_ok_temp.blnnya = dbo.lap_kunjungan_ok_BpjsPbi_v.bln AND 
                      dbo.lap_kunjungan_ok_temp.thnnya = dbo.lap_kunjungan_ok_BpjsPbi_v.thn LEFT OUTER JOIN
                      dbo.lap_kunjungan_ok_BpjsKtngkrjn_v ON dbo.lap_kunjungan_ok_temp.tglnya = dbo.lap_kunjungan_ok_BpjsKtngkrjn_v.tgl AND 
                      dbo.lap_kunjungan_ok_temp.blnnya = dbo.lap_kunjungan_ok_BpjsKtngkrjn_v.bln AND dbo.lap_kunjungan_ok_temp.thnnya = dbo.lap_kunjungan_ok_BpjsKtngkrjn_v.thn AND 
                      dbo.lap_kunjungan_ok_temp.kode_bagian = dbo.lap_kunjungan_ok_BpjsKtngkrjn_v.kode_bagian LEFT OUTER JOIN
                      dbo.lap_kunjungan_ok_pt_v ON dbo.lap_kunjungan_ok_temp.tglnya = dbo.lap_kunjungan_ok_pt_v.tgl AND dbo.lap_kunjungan_ok_temp.blnnya = dbo.lap_kunjungan_ok_pt_v.bln AND 
                      dbo.lap_kunjungan_ok_temp.thnnya = dbo.lap_kunjungan_ok_pt_v.thn AND dbo.lap_kunjungan_ok_temp.kode_bagian = dbo.lap_kunjungan_ok_pt_v.kode_bagian LEFT OUTER JOIN
                      dbo.lap_kunjungan_ok_ass_v ON dbo.lap_kunjungan_ok_temp.tglnya = dbo.lap_kunjungan_ok_ass_v.tgl AND dbo.lap_kunjungan_ok_temp.blnnya = dbo.lap_kunjungan_ok_ass_v.bln AND 
                      dbo.lap_kunjungan_ok_temp.thnnya = dbo.lap_kunjungan_ok_ass_v.thn AND dbo.lap_kunjungan_ok_temp.kode_bagian = dbo.lap_kunjungan_ok_ass_v.kode_bagian LEFT OUTER JOIN
                      dbo.lap_kunjungan_ok_umum_v ON dbo.lap_kunjungan_ok_temp.tglnya = dbo.lap_kunjungan_ok_umum_v.tgl AND dbo.lap_kunjungan_ok_temp.blnnya = dbo.lap_kunjungan_ok_umum_v.bln AND 
                      dbo.lap_kunjungan_ok_temp.thnnya = dbo.lap_kunjungan_ok_umum_v.thn AND dbo.lap_kunjungan_ok_temp.kode_bagian = dbo.lap_kunjungan_ok_umum_v.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_ok_nasabah_v]");
    }
};
