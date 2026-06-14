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
        DB::statement("CREATE OR ALTER VIEW dbo.update_npp_2_v
AS
SELECT     npp, id_tc_absensi, REPLACE(npp, ' ', '') AS npp_bener
FROM         dbo.tc_absensi
WHERE     (npp LIKE '% %')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_npp_2_v]");
    }
};
