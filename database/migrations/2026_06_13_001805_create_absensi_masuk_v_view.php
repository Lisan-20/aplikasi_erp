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
        DB::statement("CREATE OR ALTER VIEW dbo.absensi_masuk_v
AS
SELECT     TOP (100) PERCENT npp, jam_masuk, CONVERT(int, '47') AS npp1
FROM         dbo.tc_absensi
WHERE     (npp <> '' AND npp IS NOT NULL AND npp NOT LIKE '% %')
ORDER BY npp DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [absensi_masuk_v]");
    }
};
