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
        DB::statement("CREATE OR ALTER VIEW dbo.bill_icu_jamkesda_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.kode_bagian, SUM(CASE WHEN bill_rs IS NULL THEN 0 ELSE bill_rs END) + SUM(CASE WHEN bill_dr1 IS NULL 
                      THEN 0 ELSE bill_dr1 END) + SUM(CASE WHEN bill_dr2 IS NULL THEN 0 ELSE bill_dr2 END) + SUM(CASE WHEN lain_lain IS NULL THEN 0 ELSE lain_lain END) 
                      AS bill, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_pelayanan.status_batal
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
GROUP BY dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_pelayanan.status_batal
HAVING      (dbo.tc_trans_pelayanan.kode_bagian IN ('031001', '032001')) AND (dbo.tc_trans_pelayanan.kode_kelompok = 10) AND (dbo.tc_trans_pelayanan.status_batal IS NULL)
ORDER BY dbo.tc_trans_pelayanan.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bill_icu_jamkesda_v]");
    }
};
