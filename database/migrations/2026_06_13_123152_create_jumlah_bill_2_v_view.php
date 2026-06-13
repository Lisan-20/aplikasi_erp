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
        DB::statement("CREATE VIEW dbo.jumlah_bill_2_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.kode_bagian, dbo.mt_bagian.nama_bagian, SUM(CASE WHEN bill_rs IS NULL 
                      THEN 0 ELSE bill_rs END) AS bill_rs, SUM(CASE WHEN bill_dr1 IS NULL THEN 0 ELSE bill_dr1 END) AS bill_dr1, SUM(CASE WHEN bill_dr2 IS NULL THEN 0 ELSE bill_dr2 END) AS bill_dr2, 
                      SUM(CASE WHEN lain_lain IS NULL THEN 0 ELSE lain_lain END) AS lain_lain, SUM(CASE WHEN diskon_rs IS NULL THEN 0 ELSE diskon_rs END) AS diskon_rs, 
                      SUM(CASE WHEN diskon_dr1 IS NULL THEN 0 ELSE diskon_dr1 END) AS diskon_dr1, SUM(CASE WHEN diskon_dr2 IS NULL THEN 0 ELSE diskon_dr2 END) AS diskon_dr2, 
                      (SUM(CASE WHEN bill_rs IS NULL THEN 0 ELSE bill_rs END) + SUM(CASE WHEN bill_dr1 IS NULL THEN 0 ELSE bill_dr1 END) + SUM(CASE WHEN bill_dr2 IS NULL THEN 0 ELSE bill_dr2 END) 
                      + SUM(CASE WHEN lain_lain IS NULL THEN 0 ELSE lain_lain END)) - (SUM(CASE WHEN diskon_rs IS NULL THEN 0 ELSE diskon_rs END) + SUM(CASE WHEN diskon_dr1 IS NULL 
                      THEN 0 ELSE diskon_dr1 END) + SUM(CASE WHEN diskon_dr2 IS NULL THEN 0 ELSE diskon_dr2 END)) AS bill_total_retur, 0 AS bill_total, dbo.tc_trans_pelayanan.kode_trans_far
FROM         dbo.tc_trans_pelayanan LEFT OUTER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian
GROUP BY dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.status_batal, dbo.tc_trans_pelayanan.kode_bagian, dbo.mt_bagian.nama_bagian, 
                      dbo.tc_trans_pelayanan.status_kredit, dbo.tc_trans_pelayanan.kode_trans_far
HAVING      (dbo.tc_trans_pelayanan.status_batal IS NULL) AND (dbo.tc_trans_pelayanan.status_kredit = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jumlah_bill_2_v]");
    }
};
