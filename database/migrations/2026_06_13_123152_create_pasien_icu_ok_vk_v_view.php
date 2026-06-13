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
        DB::statement("CREATE OR ALTER VIEW dbo.pasien_icu_ok_vk_v
AS
SELECT     no_registrasi
FROM         dbo.tc_kunjungan
WHERE     (kode_bagian_tujuan IN (030901, 030501, 031001))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_icu_ok_vk_v]");
    }
};
