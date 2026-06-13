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
        DB::statement("CREATE VIEW dbo.tagihan_farmasi_v
AS
SELECT     SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * bill_rs + (CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * lain_lain) AS bill_rs, kode_bagian, 
                      no_registrasi, kode_tc_trans_kasir, jenis_tindakan
FROM         dbo.tc_trans_pelayanan
GROUP BY kode_bagian, kode_tc_trans_kasir, status_batal, no_registrasi, jenis_tindakan
HAVING      (status_batal IS NULL) AND (kode_tc_trans_kasir IS NOT NULL) AND (kode_bagian = '060101') AND (jenis_tindakan = 11)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_farmasi_v]");
    }
};
