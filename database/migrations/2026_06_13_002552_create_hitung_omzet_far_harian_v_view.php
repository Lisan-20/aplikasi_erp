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
        DB::statement("CREATE OR ALTER VIEW dbo.hitung_omzet_far_harian_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.jenis_tindakan, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * dbo.tc_trans_pelayanan.bill_rs) - SUM(CASE WHEN dbo.tc_trans_pelayanan.diskon_rs IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.diskon_rs END) AS bill_rs, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr1) - SUM(CASE WHEN dbo.tc_trans_pelayanan.diskon_dr1 IS NULL 
                      THEN 0 ELSE dbo.tc_trans_pelayanan.diskon_dr1 END) AS bill_dr1, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr2) 
                      - SUM(CASE WHEN dbo.tc_trans_pelayanan.diskon_dr2 IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.diskon_dr2 END) AS bill_dr2, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_rs_jatah) - SUM(CASE WHEN dbo.tc_trans_pelayanan.diskon_rs IS NULL 
                      THEN 0 ELSE dbo.tc_trans_pelayanan.diskon_rs END) AS bill_rs_jatah, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * dbo.tc_trans_pelayanan.bill_dr1_jatah) - SUM(CASE WHEN dbo.tc_trans_pelayanan.diskon_dr1 IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.diskon_dr1 END) 
                      AS bill_dr1_jatah, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.bill_dr2_jatah) 
                      - SUM(CASE WHEN dbo.tc_trans_pelayanan.diskon_dr2 IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.diskon_dr2 END) AS bill_dr2_jatah, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.lain_lain) AS lain_lain, dbo.mt_bagian.validasi, 
                      dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_profit, dbo.tc_trans_kasir.tgl_jam
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
GROUP BY dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.mt_bagian.validasi, dbo.tc_trans_pelayanan.status_batal, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_profit, dbo.tc_trans_kasir.tgl_jam
HAVING      (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0) AND (dbo.mt_bagian.validasi = '060001')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hitung_omzet_far_harian_v]");
    }
};
