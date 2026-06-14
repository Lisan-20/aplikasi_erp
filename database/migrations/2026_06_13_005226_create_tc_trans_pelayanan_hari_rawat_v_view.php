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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_trans_pelayanan_hari_rawat_v
AS
SELECT     TOP (100) PERCENT jenis_tindakan, SUM(jumlah) AS hari_rawat, no_kunjungan, no_registrasi, kode_klas
FROM         dbo.tc_trans_pelayanan
GROUP BY jenis_tindakan, no_kunjungan, no_registrasi, kode_klas
HAVING      (jenis_tindakan = 1) AND (SUM(jumlah) > 0)
ORDER BY no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_trans_pelayanan_hari_rawat_v]");
    }
};
