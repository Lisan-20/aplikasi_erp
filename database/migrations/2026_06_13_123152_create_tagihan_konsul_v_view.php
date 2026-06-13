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
        DB::statement("CREATE VIEW dbo.tagihan_konsul_v
AS
SELECT     SUM(CASE WHEN bill_rs IS NULL THEN 0 ELSE bill_rs END + CASE WHEN bill_dr1 IS NULL THEN 0 ELSE bill_dr1 END) AS bill_rs, jenis_tindakan, kode_bagian, 
                      no_registrasi, kode_tc_trans_kasir
FROM         dbo.tc_trans_pelayanan
GROUP BY jenis_tindakan, kode_bagian, no_registrasi, kode_tc_trans_kasir, status_batal
HAVING      (jenis_tindakan IN (4, 12)) AND (status_batal IS NULL) AND (kode_tc_trans_kasir IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_konsul_v]");
    }
};
