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
        DB::statement("CREATE OR ALTER VIEW dbo.tagihan_adm_v
AS
SELECT     SUM(CASE WHEN bill_rs IS NULL THEN 0 ELSE bill_rs END) AS bill_rs, jenis_tindakan, kode_bagian, no_registrasi, kode_tc_trans_kasir
FROM         dbo.tc_trans_pelayanan
GROUP BY jenis_tindakan, kode_bagian, no_registrasi, kode_tc_trans_kasir, status_batal
HAVING      (jenis_tindakan = 2) AND (NOT (kode_bagian IN ('050101', '050201', '050301', '050401'))) AND (status_batal IS NULL) AND (kode_tc_trans_kasir IS NOT NULL) AND 
                      (SUM(CASE WHEN bill_rs IS NULL THEN 0 ELSE bill_rs END) > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_adm_v]");
    }
};
