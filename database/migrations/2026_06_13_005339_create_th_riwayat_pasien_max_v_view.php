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
        DB::statement("CREATE OR ALTER VIEW dbo.th_riwayat_pasien_max_v
AS
SELECT     TOP (100) PERCENT MAX(kode_riwayat) AS kode_riwayat, no_registrasi, no_mr, no_kunjungan
FROM         dbo.th_riwayat_pasien
GROUP BY no_registrasi, no_mr, no_kunjungan
ORDER BY kode_riwayat DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_riwayat_pasien_max_v]");
    }
};
