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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_pelayanan_igd_v
AS
SELECT     TOP (100) PERCENT no_kunjungan, MIN(no_registrasi) AS no_registrasi, kode_bagian, status_batal, MAX(no_registrasi) AS no_registrasi2
FROM         dbo.tc_trans_pelayanan
GROUP BY no_kunjungan, kode_bagian, status_batal
HAVING      (kode_bagian LIKE '02%' OR
                      kode_bagian LIKE '01%') AND (status_batal IS NULL)
ORDER BY MIN(no_registrasi)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_pelayanan_igd_v]");
    }
};
