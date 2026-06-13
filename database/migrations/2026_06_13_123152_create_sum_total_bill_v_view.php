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
        DB::statement("CREATE VIEW dbo.sum_total_bill_v
AS
SELECT     TOP (100) PERCENT a.no_kunjungan, a.kode_bagian, b.nama_bagian, a.npp, SUM((CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.bill_rs) AS bill_rs, 
                      SUM((CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.bill_dr1) AS bill_dr1, SUM((CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.bill_dr2) 
                      AS bill_dr2, SUM((CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.lain_lain) AS lain_lain, SUM((CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * a.diskon_rs) AS diskon_rs, SUM((CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.diskon_dr1) AS diskon_dr1, 
                      SUM((CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.diskon_dr2) AS diskon_dr2, a.no_registrasi, ((((((CASE WHEN a.status_kredit = 1 THEN (- 1) 
                      ELSE 1 END) * a.bill_rs + (CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.bill_dr1) + (CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.bill_dr2) 
                      + (CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.lain_lain) - (CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.diskon_rs) 
                      - (CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.diskon_dr1) - (CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.diskon_dr2 AS total_bill
FROM         dbo.ks_antrian_loket_v AS a LEFT OUTER JOIN
                      dbo.mt_bagian AS b ON a.kode_bagian = b.kode_bagian
GROUP BY a.no_kunjungan, a.kode_bagian, b.nama_bagian, a.npp, a.no_registrasi, ((((((CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * a.bill_rs + (CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.bill_dr1) + (CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.bill_dr2) 
                      + (CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.lain_lain) - (CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.diskon_rs) 
                      - (CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.diskon_dr1) - (CASE WHEN a.status_kredit = 1 THEN (- 1) ELSE 1 END) * a.diskon_dr2
HAVING      (a.no_registrasi > 0)
ORDER BY a.no_kunjungan, a.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_total_bill_v]");
    }
};
