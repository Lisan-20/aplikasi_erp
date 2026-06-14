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
        DB::statement("CREATE OR ALTER VIEW dbo.pasien_icu_v
AS
SELECT     no_registrasi, bagian_tujuan
FROM         dbo.ri_tc_riwayat_kelas
WHERE     (bagian_tujuan = 031001)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_icu_v]");
    }
};
