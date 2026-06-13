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
        DB::statement("CREATE VIEW dbo.diagnoza_v
AS
SELECT     TOP (100) PERCENT diagnosa, no_registrasi, MAX(kode_riwayat) AS kode_riwayat, no_kunjungan
FROM         dbo.th_riwayat_pasien
GROUP BY diagnosa, no_registrasi, no_kunjungan
ORDER BY kode_riwayat DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [diagnoza_v]");
    }
};
