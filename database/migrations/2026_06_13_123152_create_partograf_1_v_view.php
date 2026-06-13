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
        DB::statement("CREATE VIEW dbo.partograf_1_v
AS
SELECT     no_kunjungan, kode_bagian, kode_pemeriksaan, hasil, no_registrasi, no_urut_ews, no_mr, ROW_NUMBER() OVER (PARTITION BY no_registrasi
ORDER BY no_urut_ews) AS Nomor
FROM         dbo.tc_pemeriksaan_ews_det
WHERE     (kode_pemeriksaan = N'47101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [partograf_1_v]");
    }
};
