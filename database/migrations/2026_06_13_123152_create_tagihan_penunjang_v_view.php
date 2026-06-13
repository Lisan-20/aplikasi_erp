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
        DB::statement("CREATE VIEW dbo.tagihan_penunjang_v
AS
SELECT     SUM(CASE WHEN bill_rs IS NULL THEN 0 ELSE bill_rs END + CASE WHEN bill_dr1 IS NULL THEN 0 ELSE bill_dr1 END) AS bill_rs, kode_bagian, no_registrasi, 
                      kode_tc_trans_kasir
FROM         dbo.tc_trans_pelayanan
GROUP BY kode_bagian, kode_tc_trans_kasir, status_batal, no_registrasi
HAVING      (status_batal IS NULL) AND (kode_tc_trans_kasir IS NOT NULL) AND (kode_bagian IN ('050101', '050201', '050301', '050401'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_penunjang_v]");
    }
};
