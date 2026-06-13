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
        DB::statement("CREATE VIEW dbo.tc_absensi_2_v
AS
SELECT     TOP (100) PERCENT id_tc_absensi, npp, tgl_absensi
FROM         dbo.tc_absensi
WHERE     (npp <> '')
ORDER BY npp DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_absensi_2_v]");
    }
};
